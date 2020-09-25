<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Likes;
use App\Categorie;

class NewsItemController extends Controller
{
    public function index(){
        $posts = Posts::orderBy('created_at','desc')->get();
        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->get();
        $categorie = Categorie::all();
        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
            'categorie' => $categorie
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

    public function filter(Request $request){

        $posts = Posts::select('*')
            ->where('title','LIKE',$request->get('search'))
            ->where('categorie','LIKE',$request->get('categories'))
            ->where(Posts::raw('SUBSTRING(created_at,1,7)'),'LIKE',$request->get('month'))
            ->get();
        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->get();
        $categorie = Categorie::all();
        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
            'categorie' => $categorie
        ]);
    }


}
