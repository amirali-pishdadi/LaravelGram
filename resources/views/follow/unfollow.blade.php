@php
    $isFollowing = App\Models\Follower::where('user_id', Auth::id())
        ->where('follower_id', $user->id)
        ->exists();
@endphp

@if ($isFollowing)
    <form action="/unfollow" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" name="follower_id" value="{{ $user->id }}">
        <button
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-red-500 text-white">
            Unfollow
        </button>
    </form>
@else
    <form action="/follow/{{ $user->username }}" method="get">
        @csrf
        <button
            class="inline-flex items-center justify-center whitespace-nowrap rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-blue-500 text-white">
            Follow
        </button>
    </form>
@endif
