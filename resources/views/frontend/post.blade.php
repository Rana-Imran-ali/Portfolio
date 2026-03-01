@extends('layouts.frontend')

@section('title', $post->title . ' – Imran Developer')
@section('meta_description', Str::limit(strip_tags($post->content), 150))

@section('content')
<div class="pt-20">

    <article class="py-20 px-4">
        <div class="max-w-3xl mx-auto">
            
            {{-- Post Header --}}
            <header class="mb-12 text-center fade-up">
                <div class="flex items-center justify-center gap-3 mb-6">
                    <span class="tech-pill text-xs">{{ $post->category ?? 'General' }}</span>
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-6 leading-tight">{{ $post->title }}</h1>
            </header>

            {{-- Feature Image --}}
            @if($post->image)
            <div class="rounded-2xl overflow-hidden mb-12 shadow-2xl fade-up" style="animation-delay:0.1s; border:1px solid rgba(255,255,255,0.05);">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-auto object-cover max-h-[500px]">
            </div>
            @endif

            {{-- Post Content --}}
            <div class="prose prose-invert prose-lg max-w-none fade-up" style="animation-delay:0.2s;">
                {!! $post->content !!}
            </div>
            
            {{-- Back link --}}
            <div class="mt-16 pt-8 border-t border-gray-800 fade-up">
                <a href="{{ route('posts') }}" class="inline-flex items-center gap-2 text-sm font-semibold transition-colors hover:text-white" style="color:#00d4ff;">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Articles
                </a>
            </div>
            
        </div>
    </article>

</div>

<style>
/* Markdown Content overrides for dynamic post content */
.prose-invert { color: #94a3b8; }
.prose-invert h1, .prose-invert h2, .prose-invert h3, .prose-invert h4 { color: #fff; font-weight: 800; }
.prose-invert a { color: #00d4ff; text-decoration: none; }
.prose-invert a:hover { text-decoration: underline; }
.prose-invert pre { background: #0f1729; border: 1px solid rgba(255,255,255,0.1); }
</style>
@endsection
