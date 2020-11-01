@extends('user.account')

@section('page')
<section id="posts">
    @foreach($posted as $posts)

        <post>

            <img class="thumbnail" src="{{ asset('storage/postImages/'.$posts['image'])}}">
            <postTitle>{{$posts['title']}}</postTitle>
            <preview>{{$posts['description']}}</preview>
            <a href="{{route('news.show',$posts['id'])}}">View post</a>


            <vote>
                <img id="{{$posts['id']}}" src="{{asset('images/like.png')}}">
                <likes id="likes{{$posts['id']}}">
                    {{$posts['likes_of_post']}}
                </likes>
            </vote>

        </post>
        <mutate>
            <a href="{{route('user.mutatePost',$posts['id'])}}">Edit</a>


            <a id="{{$posts['id']}}" onclick="deletePost()">Delete</a>

            <label class="switch" id="{{$posts['id']}}">
                <input type="checkbox" onclick="setActive()" id="{{$posts['id']}}"@if($posts['active'] == 1) checked @endif>
                <span class="slider round"></span>
            </label>

        </mutate>

    @endforeach
</section>
@endsection
