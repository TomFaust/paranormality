@extends('layouts.master')

@section('content')

    <pages id="adminPanel">
        <a href="{{route('admin.main')}}">Main</a>
        <a href="{{route('admin.posts')}}">Posts</a>
        <a href="{{route('admin.users')}}">Users</a>
    </pages>

    @yield('page')

@endsection