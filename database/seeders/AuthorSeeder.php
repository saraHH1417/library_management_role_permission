<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        Author::factory(20)->make()->each(function($author) use($users){
            $author->user_id = $users->random()->id;
            $author->save();
        });
    }
}
