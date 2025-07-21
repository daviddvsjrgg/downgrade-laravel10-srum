@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="py-16 flex flex-col justify-center items-center bg-[#06003F]">
    <!-- Title -->
    <h1 class="text-4xl font-bold mb-1 text-white">VoiceLib</h1>
    <!-- Subtitle -->
    <p class="text-lg text-white mb-6">Masuk ke akun anda</p>

    <!-- Login Card -->
    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-sm text-center">
        <!-- Profile Icon -->
        <div class="flex justify-center mb-6 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>
        </div>

        <form method="POST" action="{{ route('auth.login.submit') }}" class="text-left">
            @csrf

            @error('email')
                <div class="text-red-600 text-sm mb-4">{{ $message }}</div>
            @enderror

            <!-- Email Address -->
            <div class="mb-4">
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Email Pengguna"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm px-3 py-2"
                    required autofocus>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Kata Sandi"
                    class="mt-1 block w-full border border-gray-400 rounded-md shadow-sm px-3 py-2"
                    required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-[#097B3C] text-white py-2 px-4 rounded-md hover:bg-[#066630] hover:cursor-pointer">Masuk</button>
            </div>
        </form>
    </div>
</div>
@endsection
