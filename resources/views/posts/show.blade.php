@extends('layouts.master')

@section('content')

    @if($posts)
        <article>
            <h1>{{$posts['title']}}</h1>
            <img src="../storage/postImages/{{$posts['image']}}">
            <h2>{{$posts['description']}}</h2>
        </article>
        <comments>

        </comments>
    @endif


    <profile>
        @if (Auth::check())
            <profilePicture></profilePicture>
            <actions class="LIActions"><a href="{{ route('posts.create') }}">Make post</a>|<a>Account</a>|<a class="dropdown-item" href="{{ route('logout') }}"
                                                                                                             onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a></actions>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <loginMsg>You are not logged in.</loginMsg>
            <actions class="LOActions"><a href="{{ route('login') }}">Log in</a>|<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></actions>
        @endif
    </profile>

    <top>

    </top>


@endsection