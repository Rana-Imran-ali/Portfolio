@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Dashboard Overview</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Projects</h3>
            <p class="text-4xl font-bold">{{ $stats['projects'] }}</p>
        </div>
        <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Skills</h3>
            <p class="text-4xl font-bold">{{ $stats['skills'] }}</p>
        </div>
        <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Posts</h3>
            <p class="text-4xl font-bold">{{ $stats['posts'] }}</p>
        </div>
        <div class="p-6 border border-gray-100 rounded-xl shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-sm font-bold uppercase tracking-widest text-gray-400 mb-2">Subscribers</h3>
            <p class="text-4xl font-bold">{{ $stats['subscribers'] }}</p>
        </div>
    </div>

    <div class="mt-16 grid lg:grid-cols-2 gap-10">
        <div class="bg-black text-white p-10 rounded-2xl">
            <h2 class="text-2xl font-bold mb-4">Quick Actions</h2>
            <div class="flex flex-wrap gap-4 mt-8">
                <a href="{{ route('admin.projects.create') }}" class="bg-white text-black px-6 py-3 rounded-full text-sm font-bold uppercase tracking-widest hover:bg-gray-100 transition-colors">Add Project</a>
                <a href="{{ route('admin.posts.create') }}" class="bg-white text-black px-6 py-3 rounded-full text-sm font-bold uppercase tracking-widest hover:bg-gray-100 transition-colors">Add Post</a>
            </div>
        </div>
        <div class="border border-gray-100 p-10 rounded-2xl">
            <h2 class="text-2xl font-bold mb-4">Site Status</h2>
            <p class="text-gray-500 mb-6">Your portfolio is currently public and accessible by anyone.</p>
            <a href="{{ route('home') }}" target="_blank" class="text-black font-bold border-b-2 border-black inline-block uppercase tracking-widest text-xs">View Live Site</a>
        </div>
    </div>
</div>
@endsection
