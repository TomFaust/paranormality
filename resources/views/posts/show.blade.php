@extends('layouts.basicPage')

@section('content')

    @if($posts)
        <article>
            <h1>{{$posts['title']}}</h1>
            <img src="{{$posts['image']}}">
            <h2>{{$posts['description']}}</h2>
        </article>
        <comments>

        </comments>
    @endif


@endsection