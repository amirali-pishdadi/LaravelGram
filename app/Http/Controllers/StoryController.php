<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Story;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoryController extends Controller
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
        return view("story.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "title"     => "required|string|max:20|min:3",
            "media_url" => "required|mimes:jpg,png|max:10240",
        ]);

        $user = Auth::user();

        if ($user) {

            $uploadedFile = $request->file("media_url");
            $fileName = time() . "." . $user->username . "." . $formFields["media_url"]->getClientOriginalName();
            $uploadedFile->move(public_path("uploads/{$user->username}/stories/"), $fileName);

            Story::create([
                "title"     => $formFields["title"],
                "media_url" => $fileName,
                "user_id"   => $user->id,
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $story_id)
    {
        if (Auth::check()) {
            $loginUser = Auth::user();
            $story = Story::where("story_id", $story_id)->first();

            if ($story && $loginUser->id == $story->user_id) {
                $deleted = DB::delete("DELETE FROM stories WHERE `stories`.`story_id` = ?", [$story_id]);
                if ($deleted) {
                    return back()->with("message", "Story Deleted Successfully");
                } else {
                    return back()->with("message", "Failed to delete the story");
                }
            } else {
                return back()->with("message", "You can't delete this story");
            }
        } else {
            return redirect("/login");
        }
    }

}
