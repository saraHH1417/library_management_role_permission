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
                <div class="card-header">Publisher
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('publishers.index') }}">Back</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <div class="lead">
                        <strong>Name:</strong>
                        {{ $publisher->name }}
                    </div>
                    <h3>Books</h3>
                    @if($publisher->books)
                        @foreach( $publisher->books as $book)
                            <h5>name: {{ $book->name }} *** author name: {{ $book->author->name }}
                                *** author id: {{ $book->author->id }} </h5>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
