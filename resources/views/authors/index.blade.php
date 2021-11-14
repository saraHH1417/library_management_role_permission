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
                        <a class="btn btn-primary" href="{{ route('authors.create') }}">New author</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('authors.show',$author->id) }}">Show</a>
                                    @can('author-edit')
                                        <a class="btn btn-primary" href="{{ route('authors.edit',$author->id) }}">Edit</a>
                                    @endcan
                                    @can('author-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['authors.destroy', $author->id],'style'=>'display:inline']) !!}
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
