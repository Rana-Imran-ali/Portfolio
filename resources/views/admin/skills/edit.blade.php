@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Edit Skill</h1>

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Skill Name</label>
            <input type="text" name="name" value="{{ $skill->name }}" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Category</label>
            <select name="category" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
                <option value="Frontend" {{ $skill->category == 'Frontend' ? 'selected' : '' }}>Frontend</option>
                <option value="Backend" {{ $skill->category == 'Backend' ? 'selected' : '' }}>Backend</option>
                <option value="Tools" {{ $skill->category == 'Tools' ? 'selected' : '' }}>Tools/DevOps</option>
                <option value="Design" {{ $skill->category == 'Design' ? 'selected' : '' }}>Design</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2">Proficiency (%)</label>
            <input type="number" name="proficiency" value="{{ $skill->proficiency }}" min="0" max="100" required class="w-full border border-gray-100 bg-gray-50 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-black">
        </div>

        <div class="pt-6">
            <button type="submit" class="bg-black text-white px-8 py-4 rounded-md text-lg font-bold hover:bg-gray-800 transition-all w-full">Update Skill</button>
        </div>
    </form>
</div>
@endsection
