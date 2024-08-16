<x-layout>
    <h1 class="title">Login to your account</h1>

    {{-- Session Messages --}}
    @if (session('status'))
        <x-flashMsg msg="{{ session('status') }}" />
    @endif

    <div class="bg-green-200 min-h-screen flex items-center">
        <div class="bg-white p-10 md:w-2/3 lg:w-1/2 mx-auto rounded">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="flex items-center mb-5">
                    <label for="email"
                        class="w-20 inline-block text-right mr-4 text-gray-500 text-gray-500">Email</label>
                    <input name="email" id="email" type="text" placeholder="Your email"
                        class="border-b-2 border-gray-400 flex-1 py-2 placeholder-gray-300 outline-none focus:border-green-400  input @error('email') ring-red-500 @enderror"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center mb-10">
                    <label for="Password"
                        class="w-20 inline-block text-right mr-4 text-gray-500 text-gray-500">Password</label>
                    <input type="password" name="password" id="password"
                        class="border-b-2 border-gray-400 flex-1 py-2 placeholder-gray-300 outline-none focus:border-green-400 input @error('password') ring-red-500 @enderror">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="text-right">
                    <button class="py-3 px-8 bg-green-500 text-green-100 font-bold rounded">Login</button>
                </div>
            </form>
        </div>
    </div>

</x-layout>
