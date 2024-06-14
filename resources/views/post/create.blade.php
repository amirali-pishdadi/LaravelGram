@extends('layout.layout')
@section('content')
    <!-- register.html -->
    <div class="flex h-screen justify-center items-center">
        <form class="w-full max-w-sm bg-white shadow-md rounded p-8" method="POST" action="/upload-post" style="background-color: var(--secondary)" enctype="multipart/form-data">
          @csrf  
          <!-- Full Name input field container styles -->
            <div class="mb-4">
                <label htmlFor="description" class="block mb-1">Description :</label>
                <input type="text" id="description" name="description" required autocomplete="off" placeholder="Description ..."
                    class="appearance-none block w-full bg-gray-200 text-black borDer  border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('description')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Email input field container styles -->
            <div class="mb-4">
                <label htmlFor="location" class="block mb-1">location :</label>
                <input type="text" id="location" name="location" required autocomplete="off"
                    placeholder="location ..."
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('location')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            <!-- Picture input field container styles -->
            <div class="mb-6">
                <label htmlFor="path" class="block mb-1">Picture :</label>
                <input type="file" id="path" name="path" required
                    class="appearance-none block w-full bg-gray-200 text-black border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('path')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            @if (session('message'))
                <p class="text-xs italic text-gray-600">{{ session('message') }}</p>
                    
            @endif

            <!-- Create Button Container Styles -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Upload</button>
        </form>
    </div>
@endsection
