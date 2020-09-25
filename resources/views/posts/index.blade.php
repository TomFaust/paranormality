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

    <profile>

        <profilePicture></profilePicture>
        <actions><a>Make post</a>|<a>Account</a>|<a>Log out</a></actions>

    </profile>

    <top>


        @foreach($top as $top)
            <a href="{{route('news.show',$top['id'])}}">View post</a>
        @endforeach
    </top>



@endsection
