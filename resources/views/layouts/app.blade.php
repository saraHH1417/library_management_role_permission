<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('mainPage') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @role('admin')
                            <li><a class="nav-link" href="{{ route('activities.index') }}">Activities</a></li>
                        @endrole
                        @can('book-list')
                            <li><a class="nav-link" href="{{ route('books.index') }}">Books</a></li>
                        @endcan
                        <li><a class="nav-link" href="{{ route('books.deleted') }}">Deleted Books</a></li>
                        @can('author-list')
                                <li><a class="nav-link" href="{{ route('authors.index') }}">Authors</a></li>
                        @endcan
                        @can('publisher-list')
                                <li><a class="nav-link" href="{{ route('publishers.index') }}">Publishers</a></li>
                        @endcan
                        @can('user-list')
                            <li><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        @endcan
                        @can('role-list')
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        @endcan
                        @can('permission-list')
                            <li><a class="nav-link" href="{{ route('permissions.index') }}">Permission</a></li>
                        @endcan

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
{{--                        action="{{ route('search') }}"--}}
                        <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('search') }}">
                            <input class="form-control mr-sm-2"
                                   id="query" name="query" type="search"
                                   placeholder="Search" value="{{ request()->get('query') }}" aria-label="Search">

                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main class="py-4">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        @yield('content')
        @yield('scripts')
    </main>
</div>
</body>
</html>
