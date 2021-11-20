@extends('layouts.app')

@section('content')
    <div class="container">
        @if($books)
            @foreach($books as $book)
                <h2>{{ $book->name }}</h2>
                <p> Author : {{ $book->author->name }}</p>
                <p> Publisher : {{ $book->publisher->name }}</p>
                <h5>{!! $book->description ?? 'No Description Exists For This Book' !!}</h5>
                <p> Created At : {{ $book->created_at->diffForHumans() }}</p>
                <hr>
            @endforeach
        @else
            No books available
        @endif
    </div>
@endsection

