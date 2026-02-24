@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Add New Project</h1>

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Title</label>
            <input type="text" name="title" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Description</label>
            <textarea name="description" rows="5" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black"></textarea>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Tech Stack (comma separated)</label>
            <input type="text" name="tech_stack" required placeholder="Laravel, Tailwind, MySQL" class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Project Link (optional)</label>
            <input type="url" name="link" class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Project Image</label>
            <input type="file" name="image" class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black text-sm">
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-black text-white px-8 py-4 rounded-md text-lg font-bold hover:bg-gray-800 transition-all w-full">Create Project</button>
        </div>
    </form>
</div>
@endsection
