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
                <div class="card-header">publishers
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('publishers.create') }}">New publisher</a>
                    </span>
                    @endcan
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Books Number</th>
                            <th width="280px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $key => $publisher)
                            <tr>
                                <td>{{ $publisher->id }}</td>
                                <td>{{ $publisher->name }}</td>
                                <td> {{ count($publisher->books) }}</td>
                                <td>
                                    <a class="btn btn-success" href="{{ route('publishers.show',$publisher->id) }}">Show</a>
                                    @can('publisher-edit')
                                        <a class="btn btn-primary" href="{{ route('publishers.edit',$publisher->id) }}">Edit</a>
                                    @endcan
                                    @can('publisher-delete')
                                        {!! Form::open(['method' => 'DELETE','route' => ['publishers.destroy', $publisher->id],'style'=>'display:inline']) !!}
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
