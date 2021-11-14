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
                <div class="card-header">Book
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('books.index') }}">Back</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Name:</strong>
                        {{ $book->name }}
                    </div>
                    <div class="lead">
                        <strong>author:</strong>
                        <a href=" {{route('authors.show' , $book->author_id) }}">
                            {{ $book->author->name }}
                        </a>
                        <br>
                        <strong>publisher:</strong>
                        <a href="{{ route('publishers.show' , $book->publisher_id) }}">
                            {{ $book->publisher->name }}
                        </a>
                        <br>
                        <strong>Quantity:</strong>
                        {{ $book->quantity }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
