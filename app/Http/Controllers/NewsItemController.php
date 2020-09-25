<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;

class NewsItemController extends Controller
{
    public function index(){
        $posts = Posts::orderBy('created_at','desc')->get();
        return view('posts.index',[
            'posts' => $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function show($id)
    {

        $posts = Posts::find($id);

        if($posts === null) {
            abort(404, 'pagina niet gevonder');
        }

        return view('posts.show',[
            'posts' => $posts
        ]);
    }


}
