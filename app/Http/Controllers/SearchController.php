<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $authors = Author::orderBy('name')->get();
        $publishers = Publisher::orderBy('name')->get();
        $results = null;
        $query = $request->get('query');
        if($query){
            $results = Book::search($query , function ($meilisearch , $query , $options) use($request){
                // this line checks if $request->get('author_id') exists and assigns it together
                if($author_id = $request->get('author_id')){
                    $options['filter'] = 'author_id=' . $author_id;
                    if($publisher_id = $request->get('publisher_id')){
                        $options['filter'] .= ' AND publisher_id=' . $publisher_id;
                    }
                }elseif($publisher_id = $request->get('publisher_id')){
                    $options['filter'] = ' publisher_id=' . $publisher_id;
                }

                return $meilisearch->search($query, $options);
            })->get();
        }
        return view('search' ,
                ['results' => $results,
                 'publishers' => $publishers,
                 'authors' => $authors
                ]
        );
    }
}
