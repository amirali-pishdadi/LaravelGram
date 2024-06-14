@extends('layout.layout')
<!-- Trending Page -->
<div class="min-h-screen bg-gray-100">
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-semibold mb-4">Trending Users</h2>
        <div class="grid grid-cols-3 gap-4">
            <!-- Dummy Pictures -->
            @foreach ($users as $user)
                <div class="bg-gray-200 rounded-lg p-4">
                    <a href="/show/{{$user->username}}">{{ $user->full_name }}</a>
                </div>
            @endforeach


            <!-- Repeat as needed -->
        </div>
    </div>
</div>