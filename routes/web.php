<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/trending", function () {
    return view("trending", [
        "users" => User::all(),
    ]);
});

// Home Page
Route::get("/" , [FollowerController::class , "index"])->middleware("auth");

// Story
Route::get("/add-story", [StoryController::class, "create"])->middleware("auth")->name("add-story");
Route::post("/add-story", [StoryController::class, "store"])->middleware("auth");
Route::get("/delete-story/{story_id}", [StoryController::class, "destroy"])->middleware("auth");

// Follow

Route::get("/follow/{username}", [FollowerController::class, "create"])->middleware("auth");
Route::post('/unfollow', [FollowerController::class, 'destroy']);

// Like
Route::get("/{post_id}/like", [LikeController::class, "store"])->middleware("auth");

// Comment
Route::get("/add/comment/{post_id}", [CommentController::class, "create"])->middleware("auth");
Route::post("/upload-comment", [CommentController::class, "store"])->middleware("auth");
Route::get("/delete-comment/{comment_id}", [CommentController::class, "destroy"])->middleware("auth");


// Post
Route::get("/upload-post", [PostController::class, "create"])->middleware("auth")->name("upload-post");
Route::post("/upload-post", [PostController::class, "store"])->middleware("auth");
Route::get("/delete/{post_id}", [PostController::class, "destroy"])->middleware("auth");
Route::get("/edit/post/{post_id}", [PostController::class, "edit"])->middleware("auth");
Route::post("/edit/post/{post_id}", [PostController::class, "update"])->middleware("auth");

// User
Route::get('register/', [UserController::class, 'create'])->middleware("guest");
Route::post('register/', [UserController::class, 'store'])->middleware("guest");
Route::get('show/{username}', [UserController::class, 'show']);
Route::get('login/', [UserController::class, 'login'])->name("login");
Route::post('login/', [UserController::class, 'authenthicate'])->middleware("guest");
Route::get("/edit/{username}", [UserController::class, "edit"], )->middleware("auth");
Route::post("/edit/{username}", [UserController::class, "update"], )->middleware("auth");
Route::get('/{username}', [UserController::class, "index"]);
Route::post("/delete/user/{username}", [UserController::class, "destroy"])->middleware("auth");
Route::get("/logout/{username}", [UserController::class, "logout"])->middleware("auth");

