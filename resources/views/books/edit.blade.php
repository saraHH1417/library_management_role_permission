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
                <div class="card-header">Edit book
                    <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('books.index') }}">books</a>
                </span>
                </div>
                <div class="card-body">
                    {!! Form::model($book, ['route' => ['books.update', $book->id], 'method'=>'PATCH']) !!}
                    <input type="hidden" name="user_id" value="{{(int) \Illuminate\Support\Facades\Auth::user()->id }}">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', $book->name, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
{{--                        {{ Form::label('author_id', 'Author :')}}--}}
{{--                        {!! Form::select('author_id', $authors, null, ['class' => 'form-control']) !!}--}}
                        <label for="author_id">Author</label>
                        <select name="author_id" id="">
                            @foreach($authors as $author)
                                <option value=" {{ $author->id }}"  {{ $author->id === $book->author_id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publisher_id">Publisher</label>
                        <select name="publisher_id" id="">
                            @foreach($publishers as $publisher)
                                <option value=" {{ $publisher->id }}" {{ $publisher->id === $book->publisher_id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Qty</label>
                        <input type="number" name="quantity" value="{{ $book->quantity }}">
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <strong>Author:</strong>--}}
{{--                        {!! Form::text('author', null, array('class' => 'form-control')) !!}--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <strong>Publisher:</strong>--}}
{{--                        {!! Form::text('publisher', null, array('class' => 'form-control')) !!}--}}
{{--                    </div>--}}

                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
