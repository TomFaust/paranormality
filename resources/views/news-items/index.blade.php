@extends('layouts.basicPage')

@section('content')

    <posts>
        @foreach($newsItems as $newsItems)

            <post>
                <img src="{{$newsItems['image']}}">
                <postTitle>{{$newsItems['title']}}</postTitle><br>
                <preview>{{$newsItems['description']}}</preview>
                <detail>View post</detail>
            </post>

        @endforeach
    </posts>

    <top>

    </top>

@endsection
