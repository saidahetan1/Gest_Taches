<x-layout>
    <a href="{{ route('dashboard') }}" class="block mb-2 text-xs text-blue-500">&larr; Go back to your dashboard</a>

    {{-- Update form card --}}
    <div class="card">
        <h2 class="font-bold mb-4">Update your post</h2>

        <form action="{{ route('todos.update', $todo) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Task Title</label>
                <input type="text" name="title" value="{{ $todo->title }}"
                    class="input @error('title') ring-red-500 @enderror">

                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="description">Task description</label>
                <textarea name="description" rows="4" class="input @error('description') ring-red-500 @enderror">{{ $todo->description }}</textarea>

                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

          
            {{-- Submit Button --}}
            <button class="btn">Update</button>
        </form>
    </div>
</x-layout>
