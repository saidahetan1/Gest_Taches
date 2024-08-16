<x-layout>
    {{-- Heading --}}
    <h1 class="title">Welcome {{ auth()->user()->username }}, you have {{ $todos->total() }} tasks</h1>

    <div class="card mb-4">
        <h2 class="font-bold mb-4">Create a new Task</h2>

        {{-- Session Messages --}}
        @if (session('success'))
            <x-flashMsg msg="{{ session('success') }}" />
        @elseif (session('delete'))
            <x-flashMsg msg="{{ session('delete') }}" bg="bg-red-500" />
        @endif

        {{-- Create Post Form --}}
        <form action="{{ route('todos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Post Title --}}
            <div class="mb-4">
                <label for="title">Task title</label>
                <input type="text" name="title" value="{{ old('title') }}"
                    class="input @error('title') ring-red-500 @enderror">

                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Body --}}
            <div class="mb-4">
                <label for="description">Task Description</label>

                <textarea name="description" rows="4" class="input @error('description') ring-red-500 @enderror">{{ old('description') }}</textarea>

                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Post Image --}}
        
            {{-- Submit Button --}}
            <button class="py-3 px-8 bg-green-500 text-green-100 font-bold rounded">Create</button>

        </form>
    </div>

    {{-- User Posts --}}
    <h2 class="font-bold mb-4">Your Latest Task</h2>


    <div class="grid grid-cols-3 gap-6">
        @foreach ($todos as $todo)
            {{-- Post card component --}}
            <x-postCard :todo="$todo">

                <div class="flex items-center justify-end gap-4 mt-6">
                    {{-- Update post --}}
                    <a href="{{ route('todos.edit', $todo) }}"
                        class="bg-green-500 text-white px-2 py-1 text-xs rounded-md">Update</a>

                    {{-- Delete post --}}
                    <form action="{{ route('todos.destroy', $todo) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-500 text-white px-2 py-1 text-xs rounded-md">Delete</button>
                    </form>
                </div>
            </x-postCard>
        @endforeach
    </div>

    {{-- Pagination links --}}
    <div>
        {{ $todos->links() }}
    </div>

</x-layout>