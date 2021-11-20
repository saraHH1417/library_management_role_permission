@extends('layouts.app')

@section('content')
    <div class="container">
        @if( count($activities) >0 )
            @foreach( $activities as $activity)
                <h2>
                    <a href="{{ route('users.show' , $activity->user_id) }}">
                        User {{ $activity->user->name }}
                    </a>
                    with id {{ $activity->user_id }}
                    {{ $activity->change_type }} ,
                    <a href="{{ route("{$activity->model}s.show" , $activity->model_id) }} ">
                        {{ $activity->model }}
                    </a>
                    at {{ $activity->created_at->diffForHumans() }}
                </h2>
                <hr>
            @endforeach
        @endif
    </div>
@endsection
