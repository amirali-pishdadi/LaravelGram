@extends("layout.layout")

@section('content')
    <!-- register.html -->
    <div class="flex h-screen justify-center items-center">
        <form class="w-full max-w-sm bg-white shadow-md rounded p-8" method="POST" action="/upload-comment" style="background-color: var(--secondary)" enctype="multipart/form-data">
          @csrf  
          <!-- Full Name input field container styles -->
            <input type="hidden" name="post_id" value="{{ $post_id }}">

            <div class="mb-4">
                <label htmlFor="text" class="block mb-1">Text :</label>
                <input type="text" id="text" name="text" required autocomplete="off" placeholder="Text ..."
                    class="appearance-none block w-full bg-gray-200 text-black borDer  border-red-500 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" />
            </div>
            @error('text')
                <p class="text-xs italic text-red-600">{{ $message }}</p>
            @enderror
            @if (session('message'))
                <p class="text-xs italic text-gray-600">{{ session('message') }}</p>
                    
            @endif

            <!-- Create Button Container Styles -->
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Comment</button>
        </form>
    </div>
@endsection