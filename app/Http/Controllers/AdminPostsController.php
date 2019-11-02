<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostsCreateRequest;
use App\Http\Requests\PostsEditRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsCreateRequest $request)
    {
        $input = $request->all();

        if ($file = $request->file('photo_path'))
        {

            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ;
            $file->move('images', $name);

            $input['photo_path'] = $name;
        }

        $input['user_id'] = Auth::user()->id;

        Post::create($input);

        Session()->flash('add_post','Post Added successfully');

        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findorfail($id);

        $categories = Category::pluck('name','id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsEditRequest $request, $id)
    {
        $input = $request->all();

        if ($file = $request->file('photo_path'))
        {

            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ;
            $file->move('images', $name);

            $input['photo_path'] = $name;
        }

        Post::findorfail($id)->update($input);

        Session()->flash('update_post','The post has been Updated successfully');

        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findorfail($id);

        $photo = str_replace($post->path,'',$post->photo_path);

        if(!empty($photo))
        {
            if(file_exists(public_path($post->photo_path)))
            {
                unlink(public_path($post->photo_path));
            }
        }

        $post->delete();

        Session()->flash('delete_post','The post has been Deleted successfully');

        return redirect ('/admin/posts');
    }

    public function post($id)
    {
        $post = Post::findorfail($id);
        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments'));
    }
}
