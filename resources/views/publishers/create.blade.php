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
                <div class="card-header">Create publisher
                    <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('publishers.index') }}">publishers</a>
                </span>
                </div>
                <div class="card-body">
                    {!! Form::open(array('route' => 'publishers.store', 'method'=>'post')) !!}
                    <input type="hidden" name="user_id" value="{{(int) \Illuminate\Support\Facades\Auth::user()->id }}">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
