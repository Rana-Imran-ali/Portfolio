@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Add Work Experience</h1>

    <form action="{{ route('admin.experience.store') }}" method="POST" class="space-y-6">
        @csrf
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Job Title</label>
            <input type="text" name="job_title" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Company</label>
            <input type="text" name="company" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Duration (e.g., 2022 - Present)</label>
            <input type="text" name="duration" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Description</label>
            <textarea name="description" rows="5" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black"></textarea>
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-black text-white px-8 py-4 rounded-md text-lg font-bold hover:bg-gray-800 transition-all w-full">Save Experience</button>
        </div>
    </form>
</div>
@endsection
