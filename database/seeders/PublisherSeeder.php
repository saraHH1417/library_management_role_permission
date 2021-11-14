<?php

namespace Database\Seeders;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        Publisher::factory(20)->make()->each(function($publisher) use($users){
            $publisher->user_id = $users->random()->id;
            $publisher->save();
        });
    }
}
