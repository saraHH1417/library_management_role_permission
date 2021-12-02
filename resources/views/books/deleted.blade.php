@extends('layouts.app')

@section('content')
    <div class="container">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        @if( count($books) > 0)
            @foreach($books as $book)
                <h2>{{ $book->name }}</h2>
                <p> Author : {{ $book->author->name }}</p>
                <p> Publisher : {{ $book->publisher->name }}</p>
                <h5>{!! $book->description ?? 'No Description Exists For This Book' !!}</h5>
                <p> Created At : {{ $book->created_at->diffForHumans() }}</p>
                <a href="{{ route('books.restore', ['book' => $book->id]) }}" class="btn btn-success">Restore</a>
                <hr>
            @endforeach
        @else
            No books has been deleted so far.
        @endif
    </div>
@endsection
