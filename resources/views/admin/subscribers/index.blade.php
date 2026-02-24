@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-bold tracking-tighter mb-10">Email Subscribers</h1>

    <div class="bg-white border border-gray-100 rounded-xl overflow-hidden">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 font-bold uppercase tracking-widest text-xs text-gray-400">
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Subscribed At</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($subscribers as $subscriber)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $subscriber->email }}</td>
                        <td class="px-6 py-4 text-gray-400 text-xs">{{ $subscriber->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 text-xs font-bold uppercase tracking-widest">
                            <span class="text-green-600">Active</span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.subscribers.destroy', $subscriber) }}" method="POST" onsubmit="return confirm('Remove this subscriber?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-600 border-b border-red-600">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-500">No subscribers yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
