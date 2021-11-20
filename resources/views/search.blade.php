@extends('layouts.app')
@section('content')
<div class="container">
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
    @if( $results )
{{--        <em> Found {{ $results->total() }} results</em>--}}
        <em> Found {{ count($results) }} Results</em>
        @foreach(  $results as $result)
            <div class="m-2">
                <h1>{{ $result->name }}</h1>
                <p>ID: {{ $result->id }}</p>
                <p>Author Name :{{ $result->author->name }}</p>
                <p>Publisher Name: {{ $result->publisher->name }}</p>
                <p>Created at: {{ $result->created_at }}</p>
                <p>Updated at: {{ $result->updated_at }}</p>
                <hr>
            </div>
        @endforeach
{{--        {{ $results->links() }}--}}
    @else
        <p>No Results Found</p>
    @endif
</div>
@endsection
