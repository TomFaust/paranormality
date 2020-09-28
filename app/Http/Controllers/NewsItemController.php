<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Likes;
use App\Categorie;
use Auth;


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
            ->limit(5)
            ->get();
        $categorie = Categorie::all();
        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
            'categorie' => $categorie
        ]);
    }

    public function create(){
        $categorie = Categorie::all();
        return view('posts.create',['categorie' => $categorie]);
    }

    public function save(Request $request){

        if ($request->hasFile('image')) {
            //  Let's do everything here
            if ($request->file('image')->isValid()) {

                $validated = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'max:1024',
                    'category' => ['exists:categories,id']
                ]);

                //$imageName = $validated['title'] . date('d-m-Y H:i:s:u');

                //$extension = $request->image->extension();
                $path = $request->file('image')->storePublicly('/public/postImages');


                $url = basename($path);

                $post = new Posts();
                $post->title = $request->get('title');
                $post->description = $request->get('description');
                $post->category = $request->get('category');
                $post->postedby = Auth::user()->id;
                $post->image = $url;

                $post->save();

                return redirect('');
            }
        }else{
            abort(404, 'pagina niet gevonder');
        }
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
            ->where('title','LIKE','%'.$request->get('search').'%')
            ->where('category','LIKE',$request->get('categories'))
            ->where(Posts::raw('SUBSTRING(created_at,1,7)'),'LIKE',$request->get('month'))
            ->orderBy('created_at','desc')
            ->get();
        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->limit(5)
            ->get();
        $categorie = Categorie::all();
        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
            'categorie' => $categorie
        ]);
    }


}
