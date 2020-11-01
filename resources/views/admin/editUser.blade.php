@extends('layouts.master')

@section('content')
    <section id="mutate">
        <form class="edit" method="get" action="{{ route('admin.saveUser') }}">
            <label for="nameE">Name:</label>
            <input type="text" name="name" id="nameE" value="{{$user['name']}}">
            <label for="email">Email:</label>
            <input type="text" name="email" value="{{$user['email']}}">
            <label for="password">Passoword:</label>
            <input type="password" name="password1">
            <label for="password">Repeat:</label>
            <input type="password" name="password2">
            <label for="admin">Admin:</label>
            <label class="switch" id="{{$user['id']}}">
                <input type="checkbox" name="admin" onclick="setAdmin()" id="{{$user['id']}}"@if($user['admin'] == 1) checked @endif>
                <span class="slider round"></span>
            </label>
            <input type="submit" value="Edit" name="submit">
        </form>
    </section>
@endsection