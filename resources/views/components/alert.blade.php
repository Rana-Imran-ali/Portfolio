@props(['type' => 'success', 'message'])

@php
    $classes = match($type) {
        'success' => 'bg-green-50 border-green-400 text-green-800',
        'error'   => 'bg-red-50 border-red-400 text-red-800',
        default   => 'bg-gray-50 border-gray-400 text-gray-800',
    };
@endphp

<div class="border-l-4 p-4 rounded-md mb-6 {{ $classes }}" role="alert">
    {{ $message }}
</div>
