<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loginUser = Auth::user();
        $postList = [];

        foreach ($loginUser->following as $following) {
            $followingUser = User::find($following->follower_id); 
            $newestPosts = $followingUser->posts()->latest()->limit(5)->get();
            array_push($postList, $newestPosts);
        }

        return view("home", [
            "postList" => $postList,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(string $username)
    {
        $user = Auth::user();
        $follower = User::where('username', $username)->first();

        if ($user && $follower) {
            if ($user->id != $follower->id) {
                $checkFollowing = Follower::where('follower_id', $follower->id)
                    ->where('user_id', $user->id)
                    ->first();

                if ($checkFollowing) {
                    return back()->with("follow", "You were already following $follower->username");
                } else {
                    Follower::create([
                        "user_id"     => $user->id,
                        "follower_id" => $follower->id,
                    ]);
                    return back()->with("follow", "You are now following $follower->username");
                }
            } else {
                return back()->with("follow", "You can't follow yourself");
            }
        } else {
            return back()->with("follow", "User or follower not found");
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(Request $request)
    {
        $formFields = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'follower_id' => 'required|exists:users,id',
        ]);

        $user_id = $formFields['user_id'];
        $follower_id = $formFields['follower_id'];


        // Find the follower record
        $follower = Follower::where('user_id', $user_id)
            ->where('follower_id', $follower_id)
            ->first();

        // If the follower record exists, delete it
        if ($follower) {
            $follower->delete();
            return back()->with("follow", "Unfollowed successfully");
        } else {
            return back()->with("follow", "Follower record not found");
        }
    }
}
