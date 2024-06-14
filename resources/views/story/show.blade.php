<span class="relative flex flex-col items-center h-20 w-20">
    <img class="aspect-square h-full w-full border rounded-full"
        src="{{ asset('uploads/' . $user->username . '/stories/' . $story->media_url) }}?height=150&amp;width=150"
        onclick="openModal('{{ $story->story_id }}')">
    <span class="text-center text-white text-xs mt-1">{{ $story->title }}</span>
</span>

<!-- The Modal -->
<div id="myModal_{{ $story->story_id }}"
    class="fixed inset-0 hidden overflow-y-auto z-50 bg-black bg-opacity-50 flex justify-center items-center">
    <!-- Modal content -->
    <div class="bg-[#242526] rounded-lg relative px-1 pt-1 pb-5">
        <button class="absolute top-0 right-0 cursor-pointer" onclick="closeModal('{{ $story->story_id }}')">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <img src="{{ asset('uploads/' . $user->username . '/stories/' . $story->media_url) }}"
            class="aspect-square h-96 w-64 rounded-lg">
        <div class="flex ">

            <span class="text-white text-center text-lg mx-auto mt-1"> {{ $story->title }} </span>
            @if (Auth::user())

                @if (Auth::user()->id == $story->user_id)
                    <button class="text-red-500 pt-2 pr-2"> <a href="/delete-story/{{ $story->story_id }}"><i
                                class="far fa-trash-alt"></i></a></button>
                @endif

            @endif

        </div>
    </div>
</div>
