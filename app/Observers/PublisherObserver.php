<?php

namespace App\Observers;

use App\Models\Publisher;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PublisherObserver
{

    protected $user_id;
    public function __construct()
    {
        $this->user_id = Auth::user()->id ?? User::all()->random()->id;
    }
    /**
     * Handle the Publisher "created" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function created(Publisher $publisher)
    {
        DB::table('activity')->insert([
            'change_type' => "created",
            'model' => 'publisher',
            'model_id' => $publisher->id,
            'user_id' => $publisher->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Publisher "updated" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function updated(Publisher $publisher)
    {
        DB::table('activity')->insert([
            'change_type' => "updated",
            'model' => 'publisher',
            'model_id' => $publisher->id,
            'user_id' => $this->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Publisher "deleted" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function deleted(Publisher $publisher)
    {
        DB::table('activity')->insert([
            'change_type' => "deleted",
            'model' => 'publisher',
            'model_id' => $publisher->id,
            'user_id' => $this->user_id,
            'created_at' => Carbon::now()->toDateTime(),
            'updated_at' => Carbon::now()->toDateTime()
        ]);
    }

    /**
     * Handle the Publisher "restored" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function restored(Publisher $publisher)
    {
        //
    }

    /**
     * Handle the Publisher "force deleted" event.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return void
     */
    public function forceDeleted(Publisher $publisher)
    {
        //
    }
}
