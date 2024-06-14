<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
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
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "description" => "required|min:3|string",
            "location"    => "string|required|min:3",
            "path"        => "required|mimes:jpg,png|max:10240",
        ]);

        $user = Auth::user();

        if ($user) {

            $uploadedFile = $request->file("path");
            $fileName = time() . "." . $user->username . "." . $formFields["path"]->getClientOriginalName();
            $uploadedFile->move(public_path("uploads/{$user->username}/posts/"), $fileName);

            Post::create([
                "description" => $formFields["description"],
                "location"    => $formFields["location"],
                "user_id"     => $user->id,
                "path"        => $fileName,
            ]);

            return redirect("/show/{$user->username}");
        } else {
            abort("404");
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
    public function edit(string $post_id)
    {
        if (Auth::check()) {
            $loginUser = Auth::user();
            $post = Post::where("post_id", $post_id)->first();

            if ($loginUser->id == $post->user_id) {

                return view("post.edit", ["post" => $post, "user" => $loginUser]);

            } else {
                return back()->with("message", "You can't edit this post");

            }
        } else {
            return redirect("/login");
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $post_id)
    {
        $formFields = $request->validate([
            "profile"     => "required|mimes:png,jpg|max:10240",
            "description" => "required|string|min:3",
            "location"    => "required|string|min:3",
        ]);

        if (Auth::check()) {
            $loginUser = Auth::user();
            $post = Post::where("post_id", $post_id)->first();

            if ($loginUser->id == $post->user_id) {
                $oldProfilePicturePath = public_path("uploads/$loginUser->username/posts/") . $post->path; // Adjust the path accordingly

                if (File::exists($oldProfilePicturePath)) {
                    // Delete the old profile picture
                    File::delete($oldProfilePicturePath);

                    $uploadedFile = $request->file("profile");
                    $fileName = time() . "." . $loginUser->username . "." . $formFields["profile"]->getClientOriginalName();
                    $uploadedFile->move(public_path("uploads/{$loginUser->username}/posts/"), $fileName);

                    $post->description = $formFields["description"];
                    $post->location = $formFields["location"];
                    $post->path = $fileName;

                    $post->save();

                    return redirect("/show/{$loginUser->username}")->with("message", "Post Edited Successfully");
                }
                return back()->with("message", "Nothing Post");


            } else {
                return back()->with("message", "You can't delete this post");

            }
        } else {
            return redirect("/login");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $post_id)
    {
        if (Auth::check()) {
            $loginUser = Auth::user();
            $post = Post::where("post_id", $post_id)->first();

            if ($loginUser->id == $post->user_id) {

                $post->delete();

                return back()->with("message", "Post Deleted Successfully");
            } else {
                return back()->with("message", "You can't delete this post");

            }
        } else {
            return redirect("/login");
        }


    }
}
