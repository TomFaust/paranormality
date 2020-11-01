@extends('admin.admin')

@section('page')
    <section id="posts">
        @foreach($users as $user)

            <user>

                <name>{{$user['name']}}</name>
                <email>{{$user['email']}}</email>
                <admin>{{$user['admin']}}</admin>

            </user>

            <mutate>
                <a href="{{route('admin.editUser',$user['id'])}}">Edit</a>
                <a id="{{$user['id']}}" onclick="deleteUser()">Delete</a>
            </mutate>

        @endforeach
    </section>
@endsection