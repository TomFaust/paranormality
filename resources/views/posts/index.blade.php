@extends('layouts.basicPage')

@section('content')
    <filters>
        <form action="{{ route('posts.filter') }}">
            <input type="text" name="search">
            <input type="month" name="month">
            <select name="categories">
                <option value="">--Categorie--</option>
                @foreach($categorie as $categorie)
                    <option value="{{$categorie['id']}}">{{$categorie['name']}}</option>
                @endforeach
            </select>
            <input type="submit">
        </form>
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
