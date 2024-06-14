<aside class="w-60 bg-black text-white p-4 space-y-4">
    <h1 class="text-2xl font-bold">
        Instagram
    </h1>
    <nav class="space-y-2">
        <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="/">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-white">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span>Home</span>
        </a>
        <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="/trending">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-white">
                <path d="m21 21-6-6m6 6v-4.8m0 4.8h-4.8"></path>
                <path d="M3 16.2V21m0 0h4.8M3 21l6-6"></path>
                <path d="M21 7.8V3m0 0h-4.8M21 3l-6 6"></path>
                <path d="M3 7.8V3m0 0h4.8M3 3l6 6"></path>
            </svg>
            <span>Trending User</span>
        </a>
        <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="{{ route('upload-post') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-white">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            <span>Create Post</span>
        </a>
        <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="{{ route('add-story') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="text-white">
                <path d="M12 5v14m-7-7h14"></path>
            </svg>
            <span>Add Story</span>
        </a>

        @if (Auth::check() && Auth::user()->username)
            <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="/show/{{ Auth::user()->username }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-white">
                    <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span>Profile</span>
            </a>
            <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="/logout/{{ Auth::user()->username }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-white">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                </svg>
                <span>Logout</span>
            </a>
        @else
            <a class="flex items-center space-x-2 py-2 px-4 hover:bg-gray-800 rounded" href="/login">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="text-white">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="19" cy="12" r="1"></circle>
                    <circle cx="5" cy="12" r="1"></circle>
                </svg>
                <span>Login</span>
            </a>
        @endif
    </nav>
</aside>
