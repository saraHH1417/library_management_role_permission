<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function __invoke()
    {
        $week_day =(Carbon::now()->dayOfWeek) +1;
        $books = Book::with('author' , 'publisher')
            ->whereHas('weekDays', function (Builder $query) use($week_day) {
                $query->where('week_day_id' , $week_day)
                ->whereTime('start_time' , '<' , now())
                ->whereTime('end_time' , '>' , now());
            })
            ->latest()
            ->get();
        return view('index' , ['books' => $books]);
    }
}
