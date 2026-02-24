@extends('layouts.frontend')

@section('title', 'Projects – Imran Developer')
@section('meta_description', 'Browse the featured projects built by Imran Ali, covering Laravel applications, APIs, e-commerce platforms and more.')

@section('content')
<div class="pt-20">

    {{-- ── HEADER ───────────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-cyan" style="width:500px;height:500px;top:-50px;right:0;opacity:0.3;"></div>
        <div class="max-w-7xl mx-auto text-center">
            <span class="section-label fade-up">What I've Built</span>
            <h1 class="section-title gradient-text-2 mt-2 fade-up" style="animation-delay:0.1s;">Featured Projects</h1>
            <p class="mt-4 text-lg max-w-xl mx-auto fade-up" style="color:#64748b;animation-delay:0.2s;">
                A selection of projects I'm proud of — from full-stack apps to APIs and e-commerce platforms.
            </p>
        </div>
    </section>

    {{-- ── PROJECTS GRID ──────────────────────────────────────────── --}}
    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-8">
                @forelse($projects as $project)
                    <article class="glass card-hover project-card rounded-2xl overflow-hidden fade-up group">
                        {{-- Thumbnail --}}
                        <div class="relative aspect-video overflow-hidden" style="background:#111827;">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}"
                                     alt="{{ $project->title }}"
                                     loading="lazy"
                                     class="project-img w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center relative">
                                    <div class="blob blob-cyan" style="width:200px;height:200px;top:0;left:0;opacity:0.2;"></div>
                                    <svg class="w-16 h-16 relative z-10" style="color:#1e293b;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            {{-- Hover overlay --}}
                            <div class="project-overlay">
                                @if($project->link)
                                <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                                   class="btn-primary text-xs py-2 px-4">
                                    Live Demo
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                </a>
                                @endif
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-7">
                            <h2 class="text-xl font-bold text-white mb-2">{{ $project->title }}</h2>
                            <p class="text-sm leading-relaxed mb-5" style="color:#64748b;">{{ $project->description }}</p>

                            {{-- Tech stack --}}
                            <div class="flex flex-wrap gap-2 mb-5">
                                @foreach(explode(',', $project->tech_stack) as $tech)
                                    <span class="tech-pill">{{ trim($tech) }}</span>
                                @endforeach
                            </div>

                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 text-sm font-semibold transition-colors hover:text-white"
                               style="color:#00d4ff;">
                                View Project
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            @endif
                        </div>
                    </article>
                @empty
                    {{-- Demo projects --}}
                    @foreach([
                        ['Portfolio CMS','A full-featured personal portfolio with admin dashboard, content management and email subscriptions.','Laravel · PHP · MySQL · Tailwind'],
                        ['E-Commerce Store','Complete shop with cart, checkout, Stripe payments, and order management dashboard.','Laravel · Vue.js · Stripe · MySQL'],
                        ['REST API Service','Token-authenticated API service for a mobile app with rate limiting and comprehensive docs.','Laravel · JWT · MySQL · Redis'],
                        ['Blog Platform','Multi-author blog with rich-text editor, tagging, comments and email notifications.','Laravel · Livewire · Tailwind · MySQL'],
                    ] as [$t,$d,$s])
                    <article class="glass card-hover project-card rounded-2xl overflow-hidden fade-up">
                        <div class="aspect-video flex items-center justify-center relative overflow-hidden" style="background:#0f1729;">
                            <div class="blob blob-cyan" style="width:200px;height:200px;top:0;left:0;opacity:0.15;"></div>
                            <div class="text-5xl relative z-10">💻</div>
                        </div>
                        <div class="p-7">
                            <h2 class="text-xl font-bold text-white mb-2">{{ $t }}</h2>
                            <p class="text-sm leading-relaxed mb-5" style="color:#64748b;">{{ $d }}</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(' · ', $s) as $tech)
                                <span class="tech-pill">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                    </article>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

</div>
@endsection
