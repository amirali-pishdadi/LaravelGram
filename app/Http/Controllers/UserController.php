<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $username)
    {
        // Retrieve the user with the given username from the database
        $user = User::where('username', $username)->first();

        // Check if the user exists
        if ($user) {
            // Return the main view with the user data
            return view("main", [
                "user" => $user,
            ]);
        } else {
            // Return a 404 error if the user does not exist
            abort("404");
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for user registration
        return view("user.register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate form fields from the request
        $formFields = $request->validate([
            "email"           => "email|required|min:3|unique:users,email",
            'name'            => "string|required|min:3",
            'username'        => "string|required|min:6|unique:users,username",
            'profile_picture' => 'required|mimes:jpg,png|max:10240',
            'password'        => "string|required|min:8",
            'confirmPassword' => "string|required|min:8",
        ]);

        if ($formFields["password"] == $formFields["confirmPassword"]) {
            // Handle file upload for profile picture
            $uploadedFile = $request->file("profile_picture");
            $fileName = time() . "." . $formFields["username"] . "." . $uploadedFile->getClientOriginalName();
            $uploadedFile->move(public_path("uploads/{$formFields['username']}"), $fileName);

            // Create a new user record in the database
            User::create([
                'full_name'       => $formFields["name"],
                'email'           => $formFields["email"],
                'profile_picture' => $fileName,
                'username'        => $formFields["username"],
                'password'        => $formFields["password"],
            ]);

            // Redirect the user to the login page after successful registration
            return redirect("/login");
        } else {
            return back()->with("message", "Password and confirm password should be equal");
        }
    }
    /**
     * Show Login form.
     */
    public function login(Request $request)
    {
        // Return the view for user login
        return view("user.login");
    }
    /**
     * Validate Login form and Log user into website.
     */
    public function authenthicate(Request $request)
    {
        // Validate login form fields from the request
        $formFields = $request->validate([
            'email'    => 'email|required|min:3',
            'password' => 'string|required|min:8',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($formFields)) {
            $user = User::where('email', $formFields["email"])->first();
            auth()->login($user);
            return redirect("/show/{$user->username}");
        } else {
            // Redirect the user to the registration page if authentication fails
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $username)
    {
        $user = User::where('username', $username)->first();
        if ($user) {
            return view("user.index" , ["user" => $user]);
        } else {
            abort(404);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $username)
    {
        // Retrieve the user with the given username from the database
        $user = User::where('username', $username)->first();

        // Check if the user exists
        if ($user) {
            // Return the view for user profile editing
            return view("user.edit", [
                "user" => $user,
            ]);
        } else {
            // Return a 404 error if the user does not exist
            abort("404");
        }
    }
    /**
     * Logout User.
     */
    public function logout(string $username)
    {
        // Retrieve the user with the given username from the database
        $user = User::where('username', $username)->first();

        // Check if the user exists
        if ($user == Auth::user()) {

            // Logout the authenticated user
            Auth::logout();

            // Redirect back with a success message
            return back()->with("message", "User logouted successfully");
        } else {
            // If the user is not found or does not match the authenticated user, return a 404 error
            abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate form fields from the request
        $formFields = $request->validate([
            "name"            => "string|min:3",
            "bio"             => "max:300",
            "profile"         => "mimes:jpg,png|max:10240",
            "password"        => "required|min:8|string",
            "confirmPassword" => "required|min:8|string",
        ]);

        // Check if password matches the confirm password field
        if ($formFields["password"] == $formFields["confirmPassword"]) {

            // Get the authenticated user
            $user = Auth::user();

            try {
                // Handle file upload for profile picture
                $uploadedFile = $request->file("profile");
                $fileName = time() . "." . $user->username . "." . $formFields["profile"]->getClientOriginalName();
                $uploadedFile->move(public_path("uploads/{$user->username}"), $fileName);
                $user->profile_picture = $fileName;
            } catch (\Throwable $e) {
            }

            // Hash the new password
            $hashedPassword = Hash::make($formFields["password"]);

            // Update user information with the validated form fields
            $user->full_name = $formFields['name'];
            $user->bio = $formFields['bio'];
            $user->password = $hashedPassword;

            // Save the updated user information to the database
            $user->save();

            // Redirect the user to their profile page with a success message
            return redirect("/show/{$user->username}")->with('message', 'Profile Updated');
        } else {
            // If password and confirm password do not match, redirect back with an error message
            return back()->with("message", "Password and confirm password should be equal");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $username)
    {
        // Retrieve the user with the given username from the database
        $user = User::where('username', $username)->first();

        // Check if the retrieved user matches the authenticated user
        if ($user == Auth::user()) {
            // Delete the user from the database
            $user->delete();

            // Logout the authenticated user
            Auth::logout();

            // Redirect back with a success message
            return back()->with("message", "User deleted successfully");
        } else {
            // If the user is not found or does not match the authenticated user, return a 404 error
            abort(404);
        }
    }

}
