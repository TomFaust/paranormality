@extends('layouts.master')

@section('content')
    <form action="{{ route('posts.filter') }}">
        <filters>
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
            <input type="submit" value="Search">
            <input type="reset" value="Clear">
        </filters>

        <sort>
            <select name="sort" onchange="this.form.submit()">
                <option value="latest">Latest</option>
                <option value="earliest">Earliest</option>
                <option value="likes+">Most liked</option>
                <option value="likes-">Least liked</option>
            </select>
        </sort>

        <pagenav>
            @if($current - 1 < $min)
                <button name="page" value="{{$min}}"> < </button>
            @else
                <button name="page" value="{{$current - 1}}"> < </button>
            @endif

                @if($min > 1)
                    <input type="submit" name="page" value="1"> ...
                @endif

            @for($i = $min; $i <= $max; $i++)
                <input type="submit" name="page" value="{{$i}}">
            @endfor

            @if($max < $pages)
                ... <input type="submit" name="page" value="{{$pages}}">
            @endif

            @if($current + 1 > $max)
                <button name="page" value="{{$max}}"> > </button>
            @else
                <button name="page" value="{{$current + 1}}"> > </button>
            @endif
        </pagenav>

    </form>

    <posts>

        @if(empty($posts))

            <p>There were no posts found matching your criteria...</p>

        @else
            @foreach($posts as $posts)
                <post>

                    <img class="thumbnail" src="storage/postImages/{{$posts['image']}}">
                    <postTitle>{{$posts['title']}}</postTitle>
                    <preview>{{$posts['description']}}</preview>
                    <a href="{{route('news.show',$posts['id'])}}">View post</a>

                    <vote>
                        @if(Auth::id() == NULL)
                            <img id="{{$posts['id']}}" type="image" src="{{asset('images/like.png')}}" disabled>

                                    <likes id="likes{{$posts['id']}}">
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

                    </vote>
                </post>

            @endforeach

        @endif

    </posts>


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
            <topPost style="background-image: url('storage/postImages/{{$top['image']}}');">
                <a href="{{route('news.show',$top['id'])}}">{{$top['title']}}</a>
            </topPost>

        @endforeach
    </top>



@endsection
