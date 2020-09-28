@extends('layouts.master')

@section('content')
    <create>
        <form method='post' action="{{ route('posts.save') }}" enctype="multipart/form-data">
            @csrf
            <label>Title:</label>
            <input type="text" name="title">
            <label>Description:</label>
            <textarea name="description"></textarea>
            <label>Image:</label>
            <input id="image" type="file" name="image">
            <label>Category:</label>
            <select name="category">
                @foreach($categorie as $categorie)
                    <option value="{{$categorie['id']}}">{{$categorie['name']}}</option>
                @endforeach
            </select>
            <input type="submit" value="Post">
        </form>
    </create>
@endsection