@extends('layouts.basicPage')

@section('content')

    @foreach($newsItems as $newsItems)

        <post>
            <img src="{{$newsItems['image']}}">
            <postTitle>{{$newsItems['title']}}</postTitle><br>
            <preview>{{$newsItems['description']}}</preview>
            <detail>View post</detail>
        </post>

    @endforeach

@endsection
