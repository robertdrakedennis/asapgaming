<?php

namespace App\Http\Controllers;

use App\Category;

class ForumController extends Controller{
    public function index(){
        $categories = Category::root()->with(['parent','children.latestThread.user'])->get();
        return view('main.forums.index', compact('categories'));
    }
}
