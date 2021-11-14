@extends('layouts.app')

@section('content')
    @if( count($activities) >0 )
        @foreach( $activitives as $activity)
            <h2>
                User {{ $activity->user->name }} , {{ $activity->type }} , {{ $activity->content_model }}
                <a
                    href="{{ route("{$activity->content_model}s/show" , ["{$activity->content_model}" => $activity->model_id]) }} ">
                    link
                </a>
            </h2>
            <hr>
        @endforeach
    @endif
@endsection
