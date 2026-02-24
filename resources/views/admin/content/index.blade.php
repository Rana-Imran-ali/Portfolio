@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-3xl font-bold tracking-tighter">Page Contents</h1>
        <a href="{{ route('admin.content.create') }}" class="bg-black text-white px-6 py-3 rounded-md text-sm font-bold uppercase tracking-widest hover:bg-gray-800 transition-colors">Add Content</a>
    </div>

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 font-bold uppercase tracking-widest text-xs text-gray-400">
                    <th class="px-6 py-4">Key</th>
                    <th class="px-6 py-4">Value (Truncated)</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($contents as $content)
                    <tr>
                        <td class="px-6 py-4 font-bold text-sm uppercase tracking-widest">{{ $content->key }}</td>
                        <td class="px-6 py-4 text-gray-500 text-sm italic">{{ Str::limit($content->value, 50) }}</td>
                        <td class="px-6 py-4 flex space-x-4">
                            <a href="{{ route('admin.content.edit', $content) }}" class="text-sm font-bold border-b border-black">Edit</a>
                            <form action="{{ route('admin.content.destroy', $content) }}" method="POST" onsubmit="return confirm('Delete this content?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 border-b border-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center text-gray-500">No content found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
