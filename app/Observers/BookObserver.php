<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookObserver
{
    protected $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id ?? User::all()->random()->id;
    }
    /**
     * Handle the Book "created" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        Activity::create([
            'change_type' => "created",
            'model' => 'book',
            'model_id' => $book->id,
            'user_id' => $book->user_id
        ]);
    }

    /**
     * Handle the Book "updated" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function updated(Book $book)
    {
        Activity::create([
            'change_type' => "updated",
            'model' => 'book',
            'model_id' => $book->id,
            'user_id' => $this->user_id
        ]);
    }

    /**
     * Handle the Book "deleted" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function deleted(Book $book)
    {

        Activity::create([
            'change_type' => "deleted",
            'model' => 'book',
            'model_id' => $book->id,
            'user_id' => $this->user_id
        ]);

    }

    /**
     * Handle the Book "restored" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function restored(Book $book)
    {
        //
    }

    /**
     * Handle the Book "force deleted" event.
     *
     * @param  \App\Models\Book  $book
     * @return void
     */
    public function forceDeleted(Book $book)
    {
        //
    }
}
