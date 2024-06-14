@extends('layout.layout')

@section('content')
    <div class="flex">
        <!-- Left Navbar -->
        <aside class="w-50 bg-black text-white p-4 space-y-4 fixed left-0 top-0 bottom-0">
            @include('layout.left-nav')
        </aside>

        <!-- Main Section -->

        @foreach ($postList as $posts)
            <div class="min-h-screen flex flex-col gap-1">
                <div class="flex-1 overflow-y-auto ml-60">
                    @foreach ($posts as $post)
                        <main class="pb-4 md:pb-6 lg:pb-12 grid gap-4 ml-60">
                            <div class="mx-auto max-w-[935px] grid gap-4">
                                <div class="min-h-screen flex flex-col gap-1">

                                    <main class="flex-1 pb-4 md:pb-6 lg:pb-12 grid gap-4">
                                        <div class="mx-auto max-w-[935px] grid gap-4">

                                            <div class="bg-card text-card-foreground rounded-none shadow-none border"
                                                data-v0-t="card">

                                                <div class="p-0">

                                                    <div class="grid gap-4">


                                                        <div class="bg-card text-card-foreground rounded-none shadow-none border"
                                                            data-v0-t="card">
                                                            <div class="p-0">
                                                                <a href="/show/{{ App\Models\User::find($post->user_id)->username}}">
                                                                <div class="grid gap-0.5">
                                                                    <div class="flex items-center p-4"><span
                                                                            class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8 border"><span
                                                                                class="flex h-full w-full items-center justify-center rounded-full bg-muted">
                                                                                <img class="aspect-square h-full w-full object-cover"
                                                                                    alt="Profile picture"
                                                                                    src="{{ asset('uploads/' . App\Models\User::find($post->user_id)->username . '/' . App\Models\User::find($post->user_id)->profile_picture) }}?height=150&amp;width=150">
                                                                            </span></span>
                                                                        <div class="ml-3 grid gap-0.5">
                                                                            <h2 class="text-sm font-semibold leading-none">
                                                                                {{ App\Models\User::find($post->user_id)->username }}
                                                                            </h2>
                                                                            <p
                                                                                class="text-xs text-gray-500 dark:text-gray-400">
                                                                                {{ $post->created_at }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="aspect-video overflow-hidden rounded-lg">
                                                                        <img src={{ asset('uploads/' . App\Models\User::find($post->user_id)->username . '/posts/' . $post->path) }}
                                                                            width="600" height="600" alt="Picture"
                                                                            class="aspect-video object-cover">
                                                                    </div>
                                                                    <div class="p-4">
                                                                        <div class="grid gap-2 not-prose">
                                                                            <p>
                                                                                {{ $post->description }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </main>
                                </div>
                            </div>
                        </main>
                        
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
@endsection
