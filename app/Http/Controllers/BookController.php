<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiStoreBook;
use App\Http\Requests\BookStoreTime;
use App\Http\Requests\StoreBook;
use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\WeekDay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Spatie\MediaLibrary\HasMedia;

class BookController extends Controller
{
    use Searchable;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:creator|admin')->only('create' , 'store');
//        $this->middleware('permission:book-list|book-create|book-edit|book-delete', ['only' => ['index', 'show']]);
//        $this->middleware('permission:book-create', ['only' => ['create', 'store']]);
//        $this->middleware('permission:book-edit', ['only' => ['edit', 'update']]);
//        $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::orderBy('id', 'asc')->get();
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();

        $day_weeks = ['monday' , 'tuesday' , 'wednesday' , 'thursday' , 'friday' , 'saturday' , 'sunday'];
        return view('books.index',compact('data') , [
            'publishers' => $publishers,
            'authors' => $authors,
            'day_weeks' => $day_weeks
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = \App\Models\Author::all();
        $publishers = Publisher::all();
        return view('books.create' , ['authors' => $authors , 'publishers' => $publishers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBook $request)
    {
        $validatedData  = $request->validated();
        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['description'] = $request->description;
        $book = Book::create($validatedData);
        return redirect()->route('books.index')
            ->with('success','Book created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::with('author' , 'publisher')->findOrFail($id);
        $week_days = ['monday' , 'tuesday' , 'wednesday' , 'thursday' , 'friday' , 'saturday' , 'sunday'];
        return view('books.show', compact('book') , ['week_days' => $week_days]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $authors = \App\Models\Author::all();
        $publishers = Publisher::all();
        return view('books.edit',compact('book') ,['authors' => $authors , 'publishers' => $publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBook $request, $id)
    {
        $validatedData = $request->validated();

        $book = Book::findOrFail($id);

        $book->update($validatedData);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::findOrFail($id)->delete();

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }

    public function viewDeleted()
    {
        $books = Book::onlyTrashed()->get();
        return view('books.deleted' , [
            'books' => $books
        ]);
    }

    public function restore(Request $request , $id)
    {
        Book::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success' , 'Book restored Successfully');

    }

    //BookStoreTime
    public function storeTime(BookStoreTime $request , $id)
    {
        $book = Book::findOrFail($id);
        $day_name = $request->day;
        $day = WeekDay::where('name', $day_name)->first();
        $start_time = $request->input("start_time");
        $end_time = $request->input("end_time");

        $book_this_day_times = $book->weekDays()->where('week_day_id' , $day->id)->get();
        if (count($book_this_day_times) > 0) {
            foreach ($book_this_day_times as $time){
                if((($end_time < $time->pivot->start_time and $end_time < $time->pivot->end_time) or
                  ($start_time > $time->pivot->start_time and $start_time > $time->pivot->end_time)))
                {
                    continue;
                }
                else {
                    return redirect()->back()->with('error', 'This Time Interval Has Conflict With Other Intervals');
                }
            }
            $book->weekDays()->attach($day->id, ['start_time' => $start_time, 'end_time' => $end_time]);
            return redirect()->back()->with('success', 'Time Added Successfully');
        }else {
            $book->weekDays()->attach($day->id, ['start_time' => $start_time, 'end_time' => $end_time]);
            return redirect()->back()->with('success', 'Time Added Successfully');
        }

    }


    public function deleteTime(Request $request , $id)
    {
        $pivot_table_id = $request->pivot_id;
        DB::table('book_week_days')->where('id' , $pivot_table_id)->delete();

//        $relation =Book::findOrFail($id)->weekDays()->detach(function (Builder $query) use($pivot_table_id){
//            return $query->where('pivot_id' , $pivot_table_id);
//        });
//
//        dd($relation);

        return redirect()->back()->with('success' , 'Time Deleted Successfully');
    }

//    public function successStoreTime($book , $day , $start_time , $end_time)
//    {
//        $book->weekDays()->attach($day->id, ['start_time' => $start_time, 'end_time' => $end_time]);
//
//        return redirect()->back()->with('success', 'Time Added Successfully');
//    }
}

