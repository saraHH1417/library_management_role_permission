@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">authors
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('authors.index') }}">Back</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Name:</strong>
                        {{ $author->name }}
                    </div>
                    <h4> Books</h4>
                    @if($author->books)
                        @foreach( $author->books as $book)
                        <h5>name: {{ $book->name }} *** publisher name: {{ $book->publisher->name }}
                            *** publisher id: {{ $book->publisher->id }} </h5>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
