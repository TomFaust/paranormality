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
            <input type="submit">
        </filters>
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

        @if($posts->isEmpty())

            <p>There were no posts found matching your criteria...</p>

        @else
            @foreach($posts as $posts)
                <post>

                    <img class="thumbnail" src="storage/postImages/{{$posts['image']}}">
                    <postTitle>{{$posts['title']}}</postTitle><br>
                    <preview>{{$posts['description']}}</preview>
                    <a href="{{route('news.show',$posts['id'])}}">View post</a>

                    <vote>
                        @if(Auth::id() == NULL)

                        @else

                            <form>
                                <input class="save-data" id="{{$posts['id']}}" type="image" src="{{asset('images/like.png')}}" >
                                @csrf

                                    @for($i=0;$i<count($likes);$i++)
                                        @if($posts['id'] == $likes[$i]['post'])
                                        <likes id="likes{{$posts['id']}}">
                                            {{$likes[$i]['likes_of_post']}}
                                        </likes>
                                        @endif
                                    @endfor

                                <input type="hidden" name="post{{$posts['id']}}" value="{{$posts['id']}}"/>
                                <input type="hidden" name="user{{$posts['id']}}" value="{{Auth::id()}}"/>
                            </form>

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
                    <a>Account</a>
                    |
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </actions>
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
