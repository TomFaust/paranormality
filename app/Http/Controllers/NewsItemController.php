<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NewsItem;

class NewsItemController extends Controller
{
    public function index(){
        $newsItems = NewsItem::all();
        return view('news-items.index',[
            'newsItems' => $newsItems
        ]);
    }

    public function create(){
        return view('new-items/create');
    }

}
