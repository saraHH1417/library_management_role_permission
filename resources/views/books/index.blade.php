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
                <div class="card-header">Books
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('books.create') }}">New Book</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>QTY</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->name }}</td>
                                <td>
                                    <a href=" {{route('authors.show' , $book->author_id) }}">
                                        {{ $book->author->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('publishers.show' , $book->publisher_id) }}">
                                        {{ $book->publisher->name }}
                                    </a>
                                </td>
                                <td> {{ $book->quantity }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('books.show',$book->id) }}">Show</a>
                                    @can('book-edit')
                                        <a class="btn btn-primary" href="{{ route('books.edit',$book->id) }}">Edit</a>
                                    @endcan
                                    @can('book-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['books.destroy', $book->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
