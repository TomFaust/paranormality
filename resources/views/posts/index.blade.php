@extends('layouts.master')

@section('content')
    <filters>
        <form action="{{ route('posts.filter') }}">
            <input value="{{ app('request')->input('search') }}" type="text" name="search" placeholder="Search...">
            <input value="{{ app('request')->input('month') }}" type="month" name="month">
            <select name="categories">
                <option value="">Categorie...</option>
                @foreach($categorie as $categorie)
                    <option value="{{$categorie['id']}}"

                    @if($categorie['id']==app('request')->input('categories'))
                            selected
                            @endif

                    >{{$categorie['name']}}</option>
                @endforeach
            </select>
            <input type="submit">
        </form>
    </filters>

    <posts>
        @if($posts->isEmpty())

            <p>There were no posts found matching your criteria...</p>

        @else
            @foreach($posts as $posts)
                <post>
                    <img class="thumbnail" src="storage/postImages/{{$posts['image']}}">
                    <postTitle>{{$posts['title']}}</postTitle><br>
                    <preview>{{$posts['description']}}</preview>
                    <a href="{{route('news.show',$posts['id'])}}">View post</a>

                    <img class="vote upvote" src="{{asset('images/like.png')}}">
                    <img class="vote downvote" src="{{asset('images/like.png')}}">
                </post>

            @endforeach

        @endif
    </posts>


        <profile>
            @if (Auth::check())
            <profilePicture></profilePicture>
            <actions class="LIActions"><a href="{{ route('posts.create') }}">Make post</a>|<a>Account</a>|<a class="dropdown-item" href="{{ route('logout') }}"
                                                                                                             onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a></actions>
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
            <post style="background-image: url('storage/postImages/{{$top['image']}}');">
                <a href="{{route('news.show',$top['id'])}}">{{$top['title']}}</a>
            </post>

        @endforeach
    </top>



@endsection
