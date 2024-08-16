@props(['todo', 'full' => false])




<div class="flex flex-wrap justify-center mt-10">

    <!-- card 1 -->
    <div class="p-4 max-w-sm">
        <div class="flex rounded-lg h-full dark:bg-gray-800 bg-teal-400 p-8 flex-col">
            <div class="flex items-center mb-3">
                <div
                    class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full dark:bg-indigo-500 bg-indigo-500 text-white flex-shrink-0">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
                <h2 class="text-white dark:text-white text-lg font-medium">{{ $todo->title }}</h2>
            </div>
            <div class="flex flex-col justify-between flex-grow">
                <p class="leading-relaxed text-base text-white dark:text-gray-300">
                    <span>Posted {{ $todo->created_at->diffForHumans() }} by </span>
                    <a href="{{ route('todos.user', $todo->user) }}"
                        class="text-pink-600 font-medium">{{ $todo->user->username }}</a>
                </p>
                @if ($full)
                    {{-- Show full body text in single post page --}}
                    <div class="text-sm">
                        <span>{{ $todo->description }}</span>
                    </div>
                @else
                    {{-- Show limited body text in single post page --}}
                    <div class="text-sm">
                        <span>{{ Str::words($todo->description, 15) }}</span>
                        <a href="{{ route('todos.show', $todo) }}"
                            class="mt-3 text-black dark:text-white hover:text-blue-700 inline-flex items-center">Read
                            more &rarr;</a>

                    </div>
                @endif
            </div>
            <div>
                {{ $slot }}
            </div>
        </div>

    </div>
</div>
