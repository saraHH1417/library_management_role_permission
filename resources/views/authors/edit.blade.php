@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="justify-content-center">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opps!</strong> Something went wrong, please check below errors.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Create author
                    <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('authors.index') }}">authors</a>
                </span>
                </div>
                <div class="card-body">
                    {!! Form::model($author, ['route' => ['authors.update', $author->id], 'method'=>'PATCH']) !!}
                    {!! Form::model($author, ['route' => ['authors.update', $author->id], 'method'=>'PATCH']) !!}
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', $author->name , array('placeholder' => 'name','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
