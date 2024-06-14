<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $post_id)
    {
        return view("comment.create", ["post_id" => $post_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "post_id" => "required",
            "text"    => "required|string|min:3",
        ]);

        $user = Auth::user();

        if ($user) {
            
            Comment::create([
                "user_id" => $user->id,
                "post_id"        => $formFields["post_id"],
                "text"        => $formFields["text"],

            ]);

            return back()->with("message" , "Commented !");


        } else {
            return redirect("/login");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $comment_id)
    {
        if (Auth::check()) {
            $loginUser = Auth::user();

            $comment = DB::table('comments')->where('comment_id', $comment_id)->first();

            if ($loginUser->id == $comment->user_id) {

                DB::table('comments')->where('comment_id', $comment_id)->delete();

                return back()->with("message", "Post Deleted Successfully");
            } else {
                return back()->with("message", "You can't delete this post");

            }
        } else {
            return redirect("/login");
        }


    }
}
