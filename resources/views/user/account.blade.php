@extends('layouts.master')

@section('content')

    <pages>
        <a href="{{route('user.account')}}">Main</a>
        <a href="{{route('user.posts')}}">Posts</a>
        <a href="{{route('user.settings')}}">Settings</a>
        <a href="{{route('user.privacy')}}">Privacy</a>
    </pages>

        @yield('page')

@endsection