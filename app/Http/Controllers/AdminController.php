<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $postscount = Post::count();
        $categoriescount = Category::count();
        $commentscount = Comment::count();

        return view('admin/index', compact('postscount','categoriescount','commentscount'));
    }
}
