@extends('layout.layout')
@section('content')
    <!-- register.html -->
    <div class="flex h-screen justify-center items-center my-20">
        <form class="w-full max-w-sm bg-white shadow-md rounded p-8" method="POST" action="/register" style="background-color: var(--secondary)" enctype="multipart/form-data">
          @csrf  
          <!-- Full Name input field container styles -->
            <div class="mb-4">
                <label htmlFor="name" class="block mb-1">Full Name:</label>
                <input type="text" id="name" name="name" required autocomplete="off" placeholder="Enter full name..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('name')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Email input field container styles -->
            <div class="mb-4">
                <label htmlFor="email" class="block mb-1">Email:</label>
                <input type="email" id="email" name="email" value="{{ old("email") }}" required autocomplete="off"
                    placeholder="Enter email address..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('email')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Username input field container styles -->
            <div class="mb-4">
                <label htmlFor="username" class="block mb-1">Username:</label>
                <input type="text" id="username" name="username" required autocomplete="off"
                    placeholder="Choose a unique username..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('username')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror

            <!-- Profile Picture input field container styles -->
            <div class="mb-6">
                <label htmlFor="profile_picture" class="block mb-1">Profile Picture :</label>
                <input type="file" id="profile_picture" name="profile_picture" required
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('profile_picture')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Password input field container styles -->
            <div class="mb-6">
                <label htmlFor="password" class="block mb-1">Password:</label>
                <input type="password" id="password" name="password" required autocomplete="new-password" minlength="8"
                    placeholder="Enter password..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" />
                <p class="text-xs italic text-gray-600">Must contain at least one number, uppercase & lowercase character
                    and special symbol.</p>
            </div>
            @error('password')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Confirm Password input field container styles -->
            <div class="mb-6">
                <label htmlFor="confirmPassword" class="block mb-1">Confirm Password:</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required autocomplete="off"
                    minlength="8" placeholder="Confirm password..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @if (session('message'))
                <p class="text-xs italic text-gray-600">{{ session('message') }}</p>
                    
            @endif

            <!-- Sign Up Button Container Styles -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Sign
                Up</button>
                
            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="/login">login</a>
        </form></div>
@endsection
