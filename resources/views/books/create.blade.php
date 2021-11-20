@extends('layouts.app')
<script src="{{ asset('ckeditor/ckeditor.js') }}">

</script>
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
                <div class="card-header">Create book
                    <span class="float-right">
                    <a class="btn btn-primary" href="{{ route('books.index') }}">books</a>
                </span>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'books.store', 'method'=>'post','id' => 'submitform' ,'enctype' => 'multipart/form-data']) !!}
                    @csrf
                    <div class="form-group">
                        <strong>name:</strong>
                        {!! Form::text('name',  old('name' , $book->name ?? '') , array('placeholder' => 'name','class' => 'form-control')) !!}
                    </div>
                    <div class="form-group">
                        <label for="author_id">Author</label>
                        <select name="author_id" id="author_id">
                            @foreach($authors as $author)
                                <option value=" {{ $author->id }}">
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="publisher_id">Publisher</label>
                        <select name="publisher_id" id="">
                            @foreach($publishers as $publisher)
                                <option value=" {{ $publisher->id }}"> {{ $publisher->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Qty</label>
                        <input type="number" name="quantity">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor 4
        // instance, using default configuration.
        CKEDITOR.replace('editor1' , {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>
@endsection
