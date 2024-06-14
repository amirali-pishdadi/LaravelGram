@extends('layout.layout')



@section('content')
    <div class="flex">
        <aside class="w-60 bg-black text-white p-4 space-y-4">
            <h1 class="text-2xl font-bold">
                Instagram
            </h1>
            <nav class="space-y-2"><a class="flex items-center space-x-2" href="/home"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="text-white">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg><span>
                        Home
                    </span></a></a><a class="flex items-center space-x-2" href="/trending"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white">
                        <path d="m21 21-6-6m6 6v-4.8m0 4.8h-4.8"></path>
                        <path d="M3 16.2V21m0 0h4.8M3 21l6-6"></path>
                        <path d="M21 7.8V3m0 0h-4.8M21 3l-6 6"></path>
                        <path d="M3 7.8V3m0 0h4.8M3 3l6 6"></path>
                    </svg>
                    <span>
                        Explore
                    </span>
                </a><a class="flex items-center space-x-2" href="{{ route('upload-post') }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white">
                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                        <polyline points="7 3 7 8 15 8"></polyline>
                    </svg><span>
                        Create Post
                        @if (Auth::check() && Auth::user()->username)
                    </span></a><a class="flex items-center space-x-2" href="/show/{{ Auth::user()->username }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-white">
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>
                        Profile
                    </span></a>
                @endif
                @if (Auth::check() && Auth::user()->username)
                    <a class="flex items-center space-x-2" href="/logout/{{ Auth::user()->username }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-white">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg><span>
                            Logout
                        </span></a>
                @else
                    <a class="flex items-center space-x-2" href="/login"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <circle cx="12" cy="12" r="1"></circle>
                            <circle cx="19" cy="12" r="1"></circle>
                            <circle cx="5" cy="12" r="1"></circle>
                        </svg><span>
                            Login
                        </span></a>
                @endif
            </nav>
        </aside>
        <div class="col-start-2 px-8 col-end-4 row-start-1 row-end-2">
            <!-- Main Content Area -->
            <header class="border-b pb-2 mb-4">
                <h1 class="font-semibold text-xl leading-relaxed tracking-wide text-white">Edit Post</h1>
            </header>

            <!-- Edit Profile Form Fields -->
            <form action="/edit/post/{{ $post->post_id }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <!-- Avatar Image Uploader Container Styles -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('uploads/' . $user->username . '/posts/' . $post->path) }}" alt="Avatar image"
                        class="inline-block object-cover w-64 h-64 mr-3 rounded-sm ring-2 ring-white">
                    <label for="profile" class="cursor-pointer block text-white">Change Picture</label>
                    <input type="file" id="profile" name="profile" accept="image/*" hidden>
                </div>
                @error('profile')
                    <p class="text-xs italic text-red-600">{{ $message }}</p>
                @enderror
                <div class="mb-4">
                    <label htmlFor="description" class="block mb-1 text-white">Description :</label>
                    <input type="text" value="{{ $post->description }}" id="description" name="description" required autocomplete="off"
                        placeholder="Description ..."
                        class="appearance-none block w-full bg-gray-200 text-black borDer  border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
                </div>
                @error('description')
                    <p class="text-xs italic text-red-600">{{ $message }}</p>
                @enderror
                <!-- Email input field container styles -->
                <div class="mb-4">
                    <label htmlFor="location" class="block mb-1 text-white">location :</label>
                    <input value="{{ $post->location }}" type="text" id="location" name="location" required autocomplete="off"
                        placeholder="location ..."
                        class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
                </div>
                @error('location')
                    <p class="text-xs italic text-red-600">{{ $message }}</p>
                @enderror

                @if (session('message'))
                    <p class="text-xs italic text-gray-600">{{ session('message') }}</p>
                @endif

                <!-- Save Changes Button Container Styles -->
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Save
                    Changes</button>
            </form>
        </div>
    </div>
@endsection
