@extends('layouts.app')
@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .types {
            display: none;
        }
    </style>
    <div class="container">
        <div class="justify-content-center">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Books
                    @role('admin|creator')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('books.create') }}">New Book</a>
                    </span>
                    @endrole
                </div>
                <div class="card-body">
                    <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('search') }}">

                        <select class="form-control" name="author_id" id="">
                            <option value="">All Authors</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}"
                                    {{ $author->id == request('author_id') ? 'selected' : '' }}
                                >{{ $author->name }}</option>
                            @endforeach
                        </select>

                        <select class="form-control" name="publisher_id" id="">
                            <option value="">All Publishers</option>
                            @foreach($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ $publisher->id == request('publisher_id') ? 'selected' : '' }}
                                >{{ $publisher->name }}</option>
                            @endforeach
                        </select>
                        <input class="form-control mr-sm-2"
                               id="query" name="query" type="search"
                               placeholder="Search" value="{{ request()->get('query') }}" aria-label="Search">

                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="card-body">
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
                    <table class="table table-hover">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
{{--                            <th>Description</th>--}}
                            <th>Name</th>
                            <th>Display Time</th>
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
{{--                                <td>--}}
{{--                                    @if( $book->getFirstMediaUrl('BooksImages') )--}}
{{--                                        <img src="{{ $book->getFirstMediaUrl('BooksImages') }}"--}}
{{--                                             alt="Not Loaded Successfully" width="120px" height="100px">--}}
{{--                                    @else--}}
{{--                                        No Image--}}
{{--                                    @endif--}}
{{--                                    {!! $book->description ?? 'No Description' !!}--}}
{{--                                </td>--}}
                                <td>{{ $book->name }}</td>
                                <td>
                                    <select  id="select-day">
                                        <option value="day-week" selected>Week Day</option>
                                        @foreach( $day_weeks as $key => $day)
                                            <option  value="{{ $day }}">{{ $day }}</option>
                                        @endforeach
                                    </select>
                                    @foreach($day_weeks as $key=>$day)
                                        {!! Form::model($book, ['route' => ['books.store-time', ['book' => $book->id , 'day' => $day]], 'method'=>'POST',
                                                'class' => 'types' , 'id' => $day]) !!}
                                            <br>
                                            Start Time:<input name="start_time" type="time"
                                                       value="{{ $request->start_time ?? '' }}">
                                            <br>
                                            <br>
                                            End Time: <input name="end_time" type="time"
                                                      value="{{ $request->end_time ?? '' }}">
                                            <br>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Save Time</button>
                                        {!! Form::close() !!}
                                    @endforeach
                                </td>
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
    <script>
        $("#select-day").on("change", function() {
            let val = $(this).val();
            $(".types").hide().find('input:text').val(''); // hide and empty
            if (val) $("#" + val).show();
        });
    </script>
@endsection
