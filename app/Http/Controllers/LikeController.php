<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $postId)
    {
        $loginUser = Auth::user();
        $post = Post::where("post_id", $postId)->first();

        $liked = $loginUser->likes()->where('post_id', $postId)->exists();


        if ($liked) {
            return back()->with("message" , "you were liked it ... ");
        } else {
            Like::create([
                "user_id" => $loginUser->id , 
                "post_id" => $post->post_id ,
            ]);
            return back()->with("message", "you like it now  ");
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
    public function destroy(string $id)
    {
        //
    }
}
