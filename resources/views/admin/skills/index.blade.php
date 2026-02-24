@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold tracking-tighter">My Skills</h1>
        <a href="{{ route('admin.skills.create') }}" class="bg-black text-white px-6 py-3 rounded-md text-sm font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">Add Skill</a>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 font-bold uppercase tracking-widest text-xs text-gray-400">
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Proficiency</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($skills as $skill)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $skill->name }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm uppercase tracking-wider">{{ $skill->category }}</td>
                        <td class="px-6 py-4">
                            <div class="w-24 bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-black h-full" style="width: {{ $skill->proficiency }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 flex space-x-4">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="text-sm font-bold border-b border-black">Edit</a>
                            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Delete this skill?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 border-b border-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No skills found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
