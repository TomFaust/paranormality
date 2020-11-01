@extends('layouts.master')


@section('content')



    <create>
        @if(count($iLiked) > 5)
        <form method='post' action="{{ route('posts.save') }}" enctype="multipart/form-data">
            @csrf
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Description:</label>
            <textarea name="description" required></textarea>
            <label>Image:</label>
            <input id="image" type="file" name="image" required>
            <label>Category:</label>
            <select name="category" required>
                @foreach($categorie as $categorie)
                    <option value="{{$categorie['id']}}">{{$categorie['name']}}</option>
                @endforeach
            </select>
            <input type="submit" value="Post">
        </form>
        @else
            <p>You need to like at least 5 posts to make a post yourself.</p>
        @endif
    </create>




    <profile>
        @if (Auth::check())
            <profilePicture></profilePicture>
            <actions class="LIActions">

                    <a href="{{ route('posts.create') }}">Make post</a>
                |
                <a href="{{ route('user.account') }}">Account</a>
                |
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
            </actions>

            @if(Auth::user()->admin == 1)
                <adminButton>
                    <a href="{{ route('admin.main') }}">Admin</a>
                </adminButton>
            @endif

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <loginMsg>You are not logged in.</loginMsg>
            <actions class="LOActions"><a href="{{ route('login') }}">Log in</a>|<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></actions>
        @endif
    </profile>
@endsection
