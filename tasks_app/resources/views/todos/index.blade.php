<x-layout>
    
    <h2 class="text-3xl font-extrabold text-gray-800 mb-8">Latest tasks</h2>
    

    {{-- List of posts --}}
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
