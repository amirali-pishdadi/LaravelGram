@extends('layout.layout')

@section('content')
    <div class="flex">
        @include('layout.left-nav')

        <div class="flex-1 p-4 bg-gray-900 text-white">
            <div class="flex justify-between items-start">
                <div class="flex flex-col items-center">
                    <span class="relative flex h-32 w-32 shrink-0 overflow-hidden rounded-full">
                        <img class="aspect-square h-full w-full" alt="Profile picture"
                            src="{{ asset('uploads/' . $user->username . '/' . $user->profile_picture) }}">
                    </span>
                    <h2 class="text-2xl font-bold my-5">{{ $user->full_name }}</h2>
                    @if (Auth::check())
                        @if (Auth::user()->username != $user->username)
                            <div class="flex space-x-4">
                                @include('follow.unfollow')
                                @if (session()->has('follow'))
                                    <div class="flex items-center justify-center">
                                        <p class="text-sm italic text-gray-50">{{ session('follow') }}</p>
                                    </div>
                                @endif
                            </div>
                        @else
                            <form action="/edit/{{ Auth::user()->username }}" method="get">
                                @csrf
                                <button class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium bg-blue-500 text-white h-10 px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </button>
                            </form>
                        @endif
                    @endif
                    <ul class="flex space-x-4 mt-4">
                        <li><strong>{{ $user->posts->count() }}</strong> posts</li>
                        <li><strong>{{ $user->followers->count() }}</strong> followers</li>
                        <li><strong>{{ $user->following->count() }}</strong> following</li>
                    </ul>
                    <p class="mt-2">{{ $user->bio }}</p>
                </div>
            </div>

            <div class="flex mt-4 space-x-4 overflow-x-auto">
                @foreach ($user->stories as $story)
                    @include('story.show')
                @endforeach
            </div>

            <div class="flex mt-4 border-t border-gray-300 pt-4">
                <a class="text-white inline-flex items-center justify-center rounded-md text-sm font-medium bg-blue-500 h-10 px-4 py-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 flex-1 text-center">
                    POSTS
                </a>
            </div>

            <div class="grid grid-cols-3 gap-4 mt-4">
                @if ($user->posts->count() > 0)
                    @foreach ($user->posts as $post)
                        <div class="relative">
                            <img alt="" class="w-full h-auto" src="{{ asset('uploads/' . $user->username . '/posts/' . $post->path) }}" style="aspect-ratio: 1/1; object-fit: cover;">
                            <div class="bg-white text-black p-4 mt-2">
                                <p class="text-gray-500">{{ $post->location }}</p>
                                <p>{{ $post->description }}</p>
                                <div class="flex justify-between mt-4">
                                    <button class="text-blue-500">
                                        {{ $post->likes->count() }} <a href="/{{ $post->post_id }}/like"><i class="far fa-heart"></i></a>
                                    </button>
                                    <button class="text-blue-500" onclick="toggleComments({{ $post->post_id }})">
                                        {{ $post->comments->count() }} <i class="far fa-comment"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->username)
                                        <button class="text-blue-500"><a href="/edit/post/{{ $post->post_id }}"><i class="far fa-edit"></i></a></button>
                                    @if (Auth::check() && Auth::user()->id == $post->user_id)
                                        
                                        <button class="text-red-500"><a href="/delete/{{ $post->post_id }}"><i class="far fa-trash-alt"></i></a></button>
                                        @endif
                                    @endif
                                </div>
                                <div id="comments_{{ $post->post_id }}" class="hidden bg-gray-100 p-4 mt-2 max-h-96 overflow-auto">
                                    <form class="flex items-center justify-center" action="/upload-comment" method="POST">
                                        @csrf
                                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                        <input type="text" id="comment-text-{{ $post->post_id }}" name="text" required autocomplete="off" placeholder="Type your comment here..." class="w-full bg-gray-200 text-black border rounded text-xs px-1 py-3 focus:outline-none focus:bg-white">
                                        <button type="submit" class="bg-blue-500 my-1 hover:bg-blue-700 text-white text-sm px-2 mx-1 rounded focus:outline-none">Add Comment</button>
                                    </form>
                                    @foreach ($post->comments as $comment)
                                        @include('comment.show')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1 class="text-white font-bold">Nothing ...</h1>
                @endif
            </div>
        </div>
    </div>
    <script>
        function toggleComments(postId) {
            var commentsContainer = document.getElementById('comments_' + postId);
            commentsContainer.classList.toggle('hidden');
        }
    </script>
@endsection
