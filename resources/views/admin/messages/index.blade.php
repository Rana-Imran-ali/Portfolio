@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Messages</h1>
        <p class="admin-page-sub">View contact form submissions.</p>
    </div>
</div>

<div class="admin-card overflow-hidden">
    <div class="overflow-x-auto">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 20%">Name</th>
                    <th style="width: 20%">Email</th>
                    <th style="width: 40%">Message</th>
                    <th style="width: 10%">Date</th>
                    <th style="width: 10%" class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td class="font-semibold">{{ $msg->name }}</td>
                    <td><a href="mailto:{{ $msg->email }}" class="text-blue-400 hover:underline">{{ $msg->email }}</a></td>
                    <td>
                        <div class="text-sm truncate" style="max-width: 300px;" title="{{ $msg->message }}">
                            {{ Str::limit($msg->message, 80) }}
                        </div>
                    </td>
                    <td class="whitespace-nowrap">{{ $msg->created_at->format('M d, Y') }}<br><span class="text-xs text-gray-500">{{ $msg->created_at->format('g:i A') }}</span></td>
                    <td class="text-right whitespace-nowrap">
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="inline-block relative group" onsubmit="return confirm('Delete this message?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" title="Delete">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-12">
                        <svg class="w-12 h-12 mx-auto text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                        <p class="text-gray-400 font-medium">No messages found.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $messages->links() }}
</div>
@endsection
