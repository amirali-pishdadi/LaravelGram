<div class="flex flex-col space-y-2 py-3">
    <div class="flex items-center">
        <img src="{{ asset('uploads/' . App\Models\User::where('id', $comment->user_id)->first()->username . '/' . App\Models\User::where('id', $comment->user_id)->first()->profile_picture) }}?height=36&amp;width=36"
            class="w-8 h-8 rounded-full" alt="picture">
        <div class="ml-2 text-gray-600 text-sm">
            {{ App\Models\User::where('id', $comment->user_id)->first()->username }}
            • <span>{{ $comment->created_at }}</span>
        </div>
    </div>
    <div class="flex flex-1">
        <p class="ml-3 text-gray-600 ">{{ $comment->text }}</p>
        @if (Auth::user()->id == $comment->user_id)
                    <button class="text-red-500 flex-1"><a href="/delete-comment/{{ $comment->comment_id }}"><i class="far fa-trash-alt"></i></a></button>

        @endif
    </div>
</div>
<br>
