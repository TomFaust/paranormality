@extends('layouts.basicPage')

@section('content')
    <filters>

    </filters>

    <posts>
        @foreach($posts as $posts)

            <post>
                <img src="{{$posts['image']}}">
                <postTitle>{{$posts['title']}}</postTitle><br>
                <preview>{{$posts['description']}}</preview>
                <a href="{{route('news.show',$posts['id'])}}">View post</a>
            </post>

        @endforeach
    </posts>

    <top>

    </top>

@endsection
