<?php

namespace App\Observers;

use App\Models\Author;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorObserver
{
    /**
     * Handle the Author "created" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    protected $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id ?? User::all()->random()->id;
    }

    public function created(Author $author)
    {
        DB::table('activity')->insert([
            'change_type' => "created",
            'model' => 'author',
            'model_id' => $author->id,
            'user_id' => $author->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Author "updated" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function updated(Author $author)
    {
        DB::table('activity')->insert([
            'change_type' => "updated",
            'model' => 'author',
            'model_id' => $author->id,
            'user_id' => $this->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Author "deleted" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function deleted(Author $author)
    {
        DB::table('activity')->insert([
            'change_type' => "deleted",
            'model' => 'author',
            'model_id' => $author->id,
            'user_id' => $this->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Author "restored" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function restored(Author $author)
    {
        //
    }

    /**
     * Handle the Author "force deleted" event.
     *
     * @param  \App\Models\Author  $author
     * @return void
     */
    public function forceDeleted(Author $author)
    {
        //
    }
}
