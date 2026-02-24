@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Edit Post</h1>

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Title</label>
            <input type="text" name="title" value="{{ $post->title }}" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Content</label>
            <textarea name="content" rows="12" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">{{ $post->content }}</textarea>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Feature Image</label>
            @if($post->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $post->image) }}" class="h-32 rounded-lg grayscale">
                </div>
            @endif
            <input type="file" name="image" class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black text-sm">
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-black text-white px-8 py-4 rounded-md text-lg font-bold hover:bg-gray-800 transition-all w-full">Update Post</button>
        </div>
    </form>
</div>
@endsection
