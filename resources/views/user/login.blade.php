@extends('layout.layout')
@section('title')
    Login
@endsection
@section('content')
    <!-- login.html -->
    <div class="flex h-screen justify-center items-center">
        <form class="w-full max-w-sm bg-white shadow-md rounded p-8" style="background-color: var(--secondary)" action="/login" method="post">
            @csrf
            <!-- Input field container styles -->
            <div class="mb-4">
                <label htmlFor="email" class="block mb-1">Email :</label>
                <input type="text" id="email" name="email" required autocomplete="off" placeholder="Enter email..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <!-- Password input field container styles -->
            <div class="mb-6">
                <label htmlFor="password" class="block mb-1">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="new-password"
                    placeholder="Enter password..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" />
                <p class="text-xs italic text-gray-600">Make sure it's at least 8 characters.</p>
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <!-- Submit button container styles -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Sign
                In</button>
                <a href="/register"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Register</a>
        </form>
    </div>
@endsection
