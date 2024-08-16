<x-layout>
    {{-- Heading --}}
    <h1 class="title">{{ $user->username }}'s tasks &#9830; {{ $todos->total() }}</h1>

    {{-- User's posts --}}
    <div class="grid grid-cols-3 gap-6">
        @foreach ($todos as $todo)
            <x-postCard :todo="$todo" />
        @endforeach
    </div>

    {{-- Pagination links --}}
    <div>
        {{ $todos->links() }}
    </div>
</x-layout>
