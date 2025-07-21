{{-- resources/views/admin/profile.blade.php --}}
@extends('layouts.admin.app')

@section('content')
<div class="max-w-full mx-auto mt-10 p-6 bg-white rounded-2xl shadow-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Profile</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 font-semibold">Name</p>
            <p class="text-lg">{{ auth()->user()->name }}</p>
        </div>

        <div>
            <p class="text-gray-600 font-semibold">Email</p>
            <p class="text-lg">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <div class="mt-8">
        <a href="{{ route('auth.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="inline-block bg-red-500 text-white font-semibold px-6 py-2 rounded-xl hover:bg-red-600 transition">
            Logout
        </a>

        <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection
