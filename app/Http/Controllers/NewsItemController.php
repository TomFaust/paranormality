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

        $posts = Posts::Select('posts.id','posts.title','posts.image','posts.description')
            ->addSelect(Posts::raw('count(likes.id) as likes_of_post'))
            ->orderBy('posts.created_at','desc')
            ->leftJoin('likes','likes.post','=','posts.id')
            ->where('active',1)
            ->groupBy('posts.id')
            ->take(10)
            ->get()
            ->toArray();

        $iLiked = Likes::Select('post')
            ->Where('user','=',Auth::id())
            ->get()
            ->toArray();

        $iLiked = array_column($iLiked,'post');



        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->where('active',1)
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->limit(5)
            ->get();

        $categorie = Categorie::all();

        $pages = ceil(Posts::all()->where('active',1)->count() / 10);

        $current = 1;
        $range = 2;

        $min = $current - $range;
        if($min < 1){
            $remain = abs($min);

            if($remain == 0){
                $remain = 1;
            }elseif ($remain == 1){
                $remain = 2;
            }


            $min = 1;
        }else{
            $remain = 0;
        }

        $max = $current + $range + $remain;

        if($max > $pages){
            $min = $min - ($max - $pages);
            $max = $pages;
        }


        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
                'categorie' => $categorie,
            'min'=>$min,
            'max'=>$max,
            'current'=>$current,
            'pages'=>$pages,
            'iLiked'=>$iLiked
        ]);
    }

    public function create(){
        $categorie = Categorie::all();

        $iLiked = Likes::Select('post')
            ->Where('user','=',Auth::id())
            ->get()
            ->toArray();

        return view('posts.create',[
            'categorie' => $categorie,
            'iLiked' => $iLiked
        ]);
    }

    public function save(Request $request){

                $validator = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'image' => 'mimes:jpeg,png',
                    'category' => ['exists:categories,id']
                ]);

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


    public function show($id)
    {
        $posts = Posts::find($id);

        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->limit(5)
            ->get();

        if($posts === null) {
            abort(404, 'pagina niet gevonder');
        }

        return view('posts.show',[
            'posts' => $posts,
            'top' => $top,
        ]);
    }

    public function filter(Request $request){

        $goto = ($request->get('page') - 1) * 10;

        $posts = Posts::Select('posts.id','posts.title','posts.image','posts.description')
            ->addSelect(Posts::raw('count(likes.id) as likes_of_post'))
            ->orderBy('posts.created_at','desc')
            ->leftJoin('likes','likes.post','=','posts.id')
            ->where('title','LIKE','%'.$request->get('search').'%')
            ->where('category','LIKE',$request->get('categories'))
            ->where(Posts::raw('SUBSTRING(posts.created_at,1,7)'),'LIKE',$request->get('month'))
            ->where('active',1)
            ->groupBy('posts.id')
            ->orderBy('posts.created_at','desc')
            ->skip($goto)->take(10)
            ->get()
            ->toArray();


        $top = Likes::select('posts.id','posts.image','posts.title')
            ->addSelect(Likes::raw('count(*) as likes_of_post'))
            ->from('likes')
            ->join('posts','posts.id','=','likes.post')
            ->whereMonth('posts.created_at', '=', date('n'))
            ->where('active',1)
            ->groupBy('likes.post')
            ->orderByRaw('likes_of_post DESC')
            ->limit(5)
            ->get();

        $categorie = Categorie::all();

        $found = Posts::select('*')
            ->where('title','LIKE','%'.$request->get('search').'%')
            ->where('category','LIKE',$request->get('categories'))
            ->where(Posts::raw('SUBSTRING(created_at,1,7)'),'LIKE',$request->get('month'))
            ->where('active',1)
            ->count();

        $pages = ceil($found / 10);

        $current = $request->get('page');
        if($current == 0){
            $current = 1;
        }

        $range = 2;

        $min = $current - $range;
        if($min < 1){
            $remain = abs($min);

            if($remain == 0){
                $remain = 1;
            }elseif ($remain == 1){
                $remain = 2;
            }

            $min = 1;

        }else{
            $remain = 0;
        }

        $max = $current + $range + $remain;

        if($max > $pages){
            $min = $min - ($max - $pages);
            $max = $pages;
        }

        if($min < 1){
            $min = 1;
        }

        $iLiked = Likes::Select('post')
            ->Where('user','=',Auth::id())
            ->get()
            ->toArray();

        $iLiked = array_column($iLiked,'post');



        return view('posts.index',[
            'posts' => $posts,
            'top' => $top,
            'categorie' => $categorie,
            'min'=>$min,
            'max'=>$max,
            'current'=>$current,
            'pages'=>$pages,
            'iLiked'=>$iLiked
        ]);
    }

}
