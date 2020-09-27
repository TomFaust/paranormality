@extends('layouts.basicPage')

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

        <profilePicture></profilePicture>
        <actions><a>Make post</a>|<a>Account</a>|<a>Log out</a></actions>

    </profile>

    <top>

    </top>


@endsection