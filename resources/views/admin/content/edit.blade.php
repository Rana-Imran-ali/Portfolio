@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Edit Page Content</h1>

    <form action="{{ route('admin.content.update', $content) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Content Key</label>
            <input type="text" name="key" value="{{ $content->key }}" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black font-mono">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Value</label>
            <textarea name="value" rows="8" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">{{ $content->value }}</textarea>
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-black text-white px-8 py-4 rounded-md text-lg font-bold hover:bg-gray-800 transition-all w-full">Update Content</button>
        </div>
    </form>
</div>
@endsection
