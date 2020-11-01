@extends('layouts.master')

@section('content')



    @if($posts)

        @if($posts['active'] == 0)

            @if($posts['postedby'] == Auth::id())

                <article>

                    <postLikes>

                        @if(Auth::id() == NULL)
                            <img src="{{asset('images/like.png')}}" class="like">

                            <likes>
                                {{$posts['likes_of_post']}}
                            </likes>
                        @else
                            <img
                                    @if(array_search($posts['id'],$iLiked))

                                    style="filter:grayscale(0%)"

                                    @else

                                    style="filter:grayscale(100%)"

                                    @endif

                                    onclick="sendJSON()" id="{{$posts['id']}}" src="{{asset('images/like.png')}}">
                            @csrf

                            <likes id="likes{{$posts['id']}}">
                                {{$posts['likes_of_post']}}
                            </likes>

                        @endif

                    </postLikes>

                    <h1>{{$posts['title']}}</h1>
                    <img class="visual" src="../storage/postImages/{{$posts['image']}}">
                    <h2>{{$posts['description']}}</h2>
                </article>
                <comments>

                </comments>

            @else

                <article style="text-align: center">

                    Sorry, this post is inactive or was deleted

                </article>

            @endif

        @else

            <article>

                <postLikes>

                @if(Auth::id() == NULL)
                    <img src="{{asset('images/like.png')}}" class="like">

                    <likes>
                        {{$posts['likes_of_post']}}
                    </likes>
                @else
                    <img
                            @if(array_search($posts['id'],$iLiked))

                            style="filter:grayscale(0%)"

                            @else

                            style="filter:grayscale(100%)"

                            @endif

                            onclick="sendJSON()" id="{{$posts['id']}}" src="{{asset('images/like.png')}}">
                    @csrf

                    <likes id="likes{{$posts['id']}}">
                        {{$posts['likes_of_post']}}
                    </likes>

                @endif

                </postLikes>

                <h1>{{$posts['title']}}</h1>
                <img class="visual" src="../storage/postImages/{{$posts['image']}}">
                <h2>{{$posts['description']}}</h2>
            </article>
            <comments>

            </comments>

        @endif
    @endif


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

    <top>
        <p>Top posts of <?php echo date('F') ?></p>
        @foreach($top as $top)
            <topPost style="background-image: url('../storage/postImages/{{$top['image']}}');">
                <a href="{{route('news.show',$top['id'])}}">{{$top['title']}}</a>
            </topPost>

        @endforeach
    </top>


@endsection