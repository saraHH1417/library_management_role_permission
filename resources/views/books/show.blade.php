@extends('layouts.app')
@section('content')
    <style>
        .blue {
            color: #1d75b3;
        }
         .types {
             display: none;
         }
    </style>
    <div class="container">
        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <p>{{ \Session::get('error') }}</p>
            </div>
        @elseif(\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div>
        @endif
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">Book
                    @can('role-create')
                        <span class="float-right">
                        <a class="btn btn-primary" href="{{ route('books.index') }}">Back</a>
                    </span>
                    @endcan
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
                        <hr>
                        <Strong>Add Display Time</Strong>
                            <div class="card-body">
                                <select  id="select-day">
                                    <option value="day-week" selected>Week Day</option>
                                    @foreach( $week_days as $key => $day)
                                        <option  value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                                @foreach($week_days as $key=>$day)
                                    {!! Form::model($book, ['route' => ['books.store-time', ['book' => $book->id , 'day' => $day]], 'method'=>'POST',
                                            'class' => 'types' , 'id' => $day]) !!}
                                    <br>
                                    Start Time:<input name="start_time" type="time" value="{{ old('start_time' , $start_time ?? '') }}">
                                    <br>
                                    <br>
                                    End Time: <input name="end_time" type="time" value="{{ old('end_time' , $end_time ?? '') }}">
                                    <br>
                                    <br>
                                    <button type="submit" class="btn btn-primary">Save Time</button>
                                    {!! Form::close() !!}
                                @endforeach
                            </div>
                        <hr>
                        <strong>Display times</strong>
                        <br>
                        @forelse($book->weekDays as $weekDay)
                            <div class="card-body">
{{--                            {{dd($weekDay)}}--}}
                                Day <span class="blue">{{ $weekDay->name }}</span>
                                From <span class="blue" >{{ $weekDay->pivot->start_time }}</span>
                                To <span class="blue"> {{ $weekDay->pivot->end_time }} </span>
                                {!! Form::model($book, ['route' => ['books.delete-time',
                                                ['book' => $book->id , 'pivot_id' => $weekDay->pivot->id]],
                                                 'method'=>'DELETE']) !!}
                                <button type="submit" class="btn btn-danger">Delete</button>
                                {!! Form::close() !!}
                            </div>
                        @empty
                          <p>This Book Has No Display Time</p>
                        @endforelse
                    </div>
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
