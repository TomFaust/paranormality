@extends('layouts.master')

@section('content')


<section id="mutate">

    <form class="edit" method="post" action="{{ route('user.updatePost') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" value="{{$posted['title']}}">
        <img src="{{asset('storage/postImages/'.$posted['image'])}}">
        <input type="file" name="image" onchange="previewFile()">
        <textarea name="description">{{ $posted['description'] }}</textarea>
        <select name="categories">
            <option value="">Categorie...</option>
            @foreach($categorie as $categorie)
                <option value="{{$categorie['id']}}"

                        @if($categorie['id'] == $posted['category'])
                        selected
                        @endif

                >{{$categorie['name']}}</option>
            @endforeach
        </select>

        <input type="submit" name="submit" value="edit">
    </form>

</section>

@endsection