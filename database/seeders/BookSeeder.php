<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $users = User::all();

        Book::factory(50)->make()->each(function ($book) use($authors , $publishers , $users){
            $book->author_id = $authors->random()->id;
            $book->publisher_id = $publishers->random()->id;
            $book->user_id = $users->random()->id;
            $book->save();
        });
    }
}
