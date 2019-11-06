<?php

namespace App\Http\Controllers;

use App\Comment;
use App\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        request()->validate(['body' => 'required|min:5|max:255']);

        CommentReply::create(
            [
                'comment_id'=> $request->comment_id,
                'body'   => $request->reply,
                'author' => $user->name,
                'email'  => $user->email,
                'photo'  => $user->photo_path,
            ]);

        Session()->flash('reply_message','Your reply has been submitted and is waiting moderator review');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::FindorFail($id);

        $replies = $comment->replies;

        return view('admin.comments.replies.show', compact('replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        CommentReply::findorfail($id)->update(['is_active'=> 1]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommentReply::findorfail($id)->delete();

        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $replies = CommentReply::FindorFail($request->checkBoxArray);

        if (empty($request->checkBoxArray))
        {
            return redirect()->back();
        }
        else
        {
            foreach ($replies as $reply)

                $reply->delete();

            return redirect()->back();
        }

        return redirect()->back();
    }
}
