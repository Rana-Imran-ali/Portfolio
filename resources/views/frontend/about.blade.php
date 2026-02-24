@extends('layouts.frontend')

@section('title', 'About Me – Imran Developer')
@section('meta_description', 'Learn more about Imran Ali, a passionate full-stack web developer with expertise in Laravel, PHP, and modern web technologies.')

@section('content')
<div class="pt-20">

    {{-- ── HERO BANNER ─────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-cyan"  style="width:500px;height:500px;top:-100px;right:-100px;opacity:0.4;"></div>
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-4 fade-up">
                <span class="section-label">Who I Am</span>
            </div>
            <h1 class="section-title text-center gradient-text-2 fade-up" style="animation-delay:0.1s;">About Me</h1>
        </div>
    </section>

    {{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-16 items-start">

                {{-- Text --}}
                <div class="fade-up">
                    <div class="space-y-5 text-lg leading-relaxed mb-10" style="color:#94a3b8;">
                        {!! $content->value ?? '
                        <p>Hello! I\'m <strong style="color:#e2e8f0;">Imran Ali</strong>, a results-driven full-stack web developer based in Rawalpindi, Pakistan, with a passion for building clean, scalable web applications.</p>
                        <p>With <strong style="color:#00d4ff;">3+ years</strong> of hands-on experience, I specialise in the <strong style="color:#e2e8f0;">Laravel ecosystem</strong> — from architecting robust backends and RESTful APIs to crafting responsive, accessible frontends.</p>
                        <p>I believe great software is equal parts engineering and empathy. Every line of code I write is guided by the question: <em style="color:#e2e8f0;">"Does this genuinely help the end user?"</em></p>
                        <p>When I\'m not coding, I\'m exploring new frameworks, contributing to open-source, or diving deep into system design concepts.</p>
                        ' !!}
                    </div>

                    {{-- Quick facts --}}
                    <div class="grid grid-cols-2 gap-4">
                        @foreach([
                            ['📍','Location','Rawalpindi, Pakistan'],
                            ['💼','Status','Open to Work'],
                            ['🎓','Education','CS Graduate'],
                            ['🌐','Languages','English, Urdu'],
                        ] as [$icon,$key,$val])
                        <div class="glass p-4 rounded-xl">
                            <div class="text-xl mb-2">{{ $icon }}</div>
                            <div class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#00d4ff;">{{ $key }}</div>
                            <div class="text-sm font-semibold text-white">{{ $val }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Photo / Card --}}
                <div class="fade-up" style="animation-delay:0.2s;">
                    {{-- Avatar placeholder --}}
                    <div class="glass-strong rounded-3xl overflow-hidden aspect-square flex items-center justify-center mb-6 relative" style="max-width:380px;margin:0 auto;">
                        <div class="blob blob-cyan" style="width:300px;height:300px;top:0;left:0;opacity:0.3;"></div>
                        <div class="relative z-10 text-center">
                            <div class="w-28 h-28 rounded-full flex items-center justify-center mx-auto mb-4" style="background:linear-gradient(135deg,#00d4ff20,#7c3aed20);border:2px solid rgba(0,212,255,0.3);">
                                <svg class="w-14 h-14" style="color:#00d4ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div class="text-2xl font-black text-white">Imran Ali</div>
                            <div class="text-sm mt-1" style="color:#00d4ff;">Full-Stack Developer</div>
                        </div>
                    </div>

                    {{-- Values --}}
                    <div class="space-y-3" style="max-width:380px;margin:0 auto;">
                        @foreach([
                            ['Clean Code','I write maintainable, well-documented code every time.'],
                            ['User First','UX and performance are always top priorities.'],
                            ['Always Learning','Constantly exploring new technologies.'],
                        ] as [$title,$desc])
                        <div class="glass flex items-start gap-4 p-4 rounded-xl">
                            <span class="mt-0.5 w-5 h-5 rounded-full flex items-center justify-center flex-shrink-0" style="background:rgba(0,212,255,0.15);">
                                <svg class="w-3 h-3" style="color:#00d4ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                            </span>
                            <div>
                                <div class="text-sm font-bold text-white">{{ $title }}</div>
                                <div class="text-xs mt-0.5" style="color:#64748b;">{{ $desc }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA ──────────────────────────────────────────────────── --}}
    <section class="py-16 px-4">
        <div class="max-w-2xl mx-auto text-center fade-up">
            <p class="text-lg mb-6" style="color:#64748b;">Interested in working together?</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('contact') }}" class="btn-primary">Get in Touch</a>
                <a href="{{ route('projects') }}" class="btn-outline">View Projects</a>
            </div>
        </div>
    </section>

</div>
@endsection
