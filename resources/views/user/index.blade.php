@extends('layout.layout')

@section('content')
    <div class="flex">
        @include('layout.left-nav')
        <div class="flex-1 p-4 bg-gray-900">
            <div class="flex justify-between items-start mb-6">
                <div class="flex flex-col items-center md:flex-row md:items-start md:space-x-4">
                    <span class="relative flex h-32 w-32 shrink-0 overflow-hidden rounded-full">
                        <img class="aspect-square h-full w-full object-cover" alt="Profile picture"
                            src="{{ asset('uploads/' . $user->username . '/' . $user->profile_picture) }}?height=150&amp;width=150">
                    </span>
                    <div class="text-center md:text-left mt-4 md:mt-0">
                        <h2 class="text-2xl font-bold text-white">{{ $user->full_name }}</h2>
                        @if (Auth::check())
                            @if (Auth::user()->username != $user->username)
                                <div class="flex justify-center md:justify-start mt-2">
                                    @include("follow.unfollow")
                                    @if (session()->has('follow'))
                                        <div class="flex items-center justify-center ml-4">
                                            <p class="text-sm italic text-gray-50">{{ session('follow') }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="mt-2">
                                    <form action="/edit/{{ Auth::user()->username }}" method="get">
                                        @csrf
                                        <button
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-blue-600 h-10 px-4 py-2 bg-blue-500 text-white">
                                            Edit Profile
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <ul class="flex space-x-4 mt-4 md:mt-0 text-white">
                    <li><strong>{{ $user->posts->count() }}</strong> posts</li>
                    <li><strong>{{ $user->followers->count() }}</strong> followers</li>
                    <li><strong>{{ $user->following->count() }}</strong> following</li>
                </ul>
            </div>
            <p class="mt-2 text-white text-center md:text-left">{{ $user->bio }}</p>
            <div class="flex mt-6 space-x-4 overflow-x-auto pb-4">
                @foreach ($user->stories as $story)
                    @include('story.show')
                @endforeach
            </div>
            <div class="flex mt-4 border-t border-gray-700 pt-4">
                <button
                    class="text-white inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-gray-800 h-10 px-4 py-2 flex-1 text-center">
                    POSTS
                </button>
            </div>
            @if ($user->posts->count() > 0)
                <div class="grid grid-cols-3 gap-1 mt-4">
                    @foreach ($user->posts as $post)
                        @include('post.show')
                    @endforeach
                </div>
            @else
                <h1 class="text-white font-bold text-center mt-4">
                    Nothing ...
                </h1>
            @endif
        </div>
    </div>
    <script>
        function toggleComments(postId) {
            var commentsContainer = document.getElementById('comments_' + postId);
            if (commentsContainer.classList.contains('hidden')) {
                commentsContainer.classList.remove('hidden');
            } else {
                commentsContainer.classList.add('hidden');
            }
        }

        function toggleCommentBox(postId) {
            var commentBox = document.getElementById('comment-box-' + postId);
            if (commentBox.style.display === 'none' || commentBox.style.display === '') {
                commentBox.style.display = 'block';
            } else {
                commentBox.style.display = 'none';
            }
        }

        function openModal(storyId) {
            document.getElementById('myModal_' + storyId).classList.remove('hidden');
        }

        function closeModal(storyId) {
            document.getElementById('myModal_' + storyId).classList.add('hidden');
        }
    </script>
@endsection
