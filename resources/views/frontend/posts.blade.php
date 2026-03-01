@extends('layouts.frontend')

@section('title', 'Blog – Imran Developer')
@section('meta_description', 'Read the latest articles on web development, Laravel, PHP, and software engineering.')

@section('content')
<div class="pt-20">

    {{-- ── HEADER ───────────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-purple" style="width:500px;height:500px;top:-50px;left:0;opacity:0.3;"></div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <span class="section-label fade-up">Blog</span>
            <h1 class="section-title gradient-text-2 mt-2 fade-up" style="animation-delay:0.1s;">Latest Articles</h1>
            <p class="mt-4 text-lg max-w-xl mx-auto fade-up" style="color:#64748b;animation-delay:0.2s;">
                Thoughts, tutorials, and insights on modern web development.
            </p>
        </div>
    </section>

    {{-- ── POSTS GRID ──────────────────────────────────────────── --}}
    <section class="py-24 px-4 bg-[#050b14]">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <article class="glass card-hover rounded-2xl overflow-hidden fade-up flex flex-col h-full group">
                        @if($post->image)
                        <div class="relative aspect-video overflow-hidden" style="background:#111827;">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" loading="lazy" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        @endif
                        <div class="p-7 flex-1 flex flex-col">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="tech-pill text-xs">{{ $post->category ?? 'General' }}</span>
                                <span class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">
                                <a href="{{ route('posts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h2>
                            <p class="text-sm leading-relaxed mb-6 flex-1 text-gray-400">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold" style="color:#00d4ff;">
                                Read Article
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="w-20 h-20 mx-auto rounded-full flex items-center justify-center mb-6" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);">
                            <svg class="w-8 h-8 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">No posts yet</h3>
                        <p class="text-gray-400">Come back soon for new articles.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16">
                {{ $posts->links() }}
            </div>
        </div>
    </section>

</div>
@endsection
