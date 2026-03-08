@extends('layouts.frontend')

@section('title', 'Imran Developer – Laravel & PHP Full-Stack Engineer')
@section('meta_description', 'Welcome to the portfolio of Imran Ali, a full-stack web developer specialising in Laravel, PHP, MySQL and Tailwind CSS. Available for freelance and full-time positions.')
@section('meta_keywords', 'Laravel developer, PHP developer, Imran Ali, full-stack developer, portfolio, hire developer')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section id="home" class="hero-bg relative min-h-screen flex items-center overflow-hidden">
    {{-- Background blobs --}}
    <div class="blob blob-cyan"  style="width:600px;height:600px;top:-100px;left:-150px;opacity:0.5;"></div>
    <div class="blob blob-purple" style="width:500px;height:500px;bottom:-80px;right:-100px;opacity:0.6;"></div>

    {{-- Floating particles --}}
    @for($i=0;$i<8;$i++)
    <div class="particle" style="left:{{ ($i*12+8) }}%;bottom:{{ ($i*6+5) }}%;animation-delay:{{ $i*0.7 }}s;animation-duration:{{ 5+$i }}s;"></div>
    @endfor

    {{-- Grid lines decoration --}}
    <div class="absolute inset-0 opacity-5" style="background-image:linear-gradient(rgba(0,212,255,0.3) 1px, transparent 1px),linear-gradient(90deg,rgba(0,212,255,0.3) 1px, transparent 1px);background-size:60px 60px;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20">
        <div class="grid lg:grid-cols-12 gap-12 items-center">

            {{-- Left content --}}
            <div class="lg:col-span-7">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 mb-6 fade-up" style="animation-delay:0.1s;">
                    <span class="w-2 h-2 rounded-full animate-pulse" style="background:#00d4ff;"></span>
                    <span class="section-label" style="margin-bottom:0;">Available for hire</span>
                </div>

                {{-- Heading --}}
                <h1 class="text-5xl md:text-6xl xl:text-7xl font-black tracking-tight leading-[1.05] mb-6 fade-up" style="animation-delay:0.2s;">
                    <span class="text-white">Hi, I'm </span><br>
                    <span class="gradient-text">Imran Ali</span>
                </h1>

                {{-- Typewriter subtitle --}}
                <div class="text-xl md:text-2xl font-semibold mb-6 fade-up" style="color:#94a3b8;animation-delay:0.3s;">
                    <span id="typewriter"></span><span class="cursor-blink"></span>
                </div>

                {{-- Description --}}
                <p class="text-lg leading-relaxed max-w-xl mb-10 fade-up" style="color:#64748b;animation-delay:0.4s;">
                    {!! $content->value ?? 'I build <strong style="color:#e2e8f0;">reliable, performant</strong> web applications using <strong style="color:#00d4ff;">Laravel & PHP</strong>. From idea to deployment — clean code, great UX.' !!}
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 mb-12 fade-up" style="animation-delay:0.5s;">
                    <a href="{{ url('/#projects') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-7 7m7-7l-7-7"/></svg>
                        View My Work
                    </a>
                    <a href="{{ url('/#contact') }}" class="btn-outline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Let's Talk
                    </a>
                    <a href="{{ route('resume') }}" class="btn-outline">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/></svg>
                        Download CV
                    </a>
                </div>

                {{-- Stats --}}
                <div class="flex flex-wrap gap-8 fade-up" style="animation-delay:0.6s;">
                    @foreach([['3+','Years Experience'],['20+','Projects Built'],['100%','Client Satisfaction']] as [$num,$label])
                    <div>
                        <div class="stat-number">{{ $num }}</div>
                        <div class="text-xs font-semibold uppercase tracking-widest mt-1" style="color:#64748b;">{{ $label }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right — Profile Picture --}}
            <div class="lg:col-span-5 fade-up flex justify-center lg:justify-end mt-16 md:mt-12 lg:mt-0 relative" style="animation-delay:0.4s;">
                <div class="relative w-full max-w-[400px] aspect-[400/450] group mx-auto lg:mx-0">
                    {{-- Animated background glow --}}
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-cyan-400 to-purple-500 opacity-20 blur-2xl group-hover:opacity-60 transition-opacity duration-500"></div>
                    
                    {{-- Avatar Base - Box --}}
                    <div class="relative z-10 w-full h-full p-2 sm:p-3 rounded-3xl shadow-[0_0_30px_rgba(0,212,255,0.15)] transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2 group-hover:shadow-[0_20px_50px_rgba(0,212,255,0.3)]" style="background: linear-gradient(135deg, rgba(30,41,59,0.5), rgba(15,23,42,0.8)); border: 1px solid rgba(0,212,255,0.3);">
                        <div class="w-full h-full rounded-2xl overflow-hidden bg-[#050b14] relative border border-slate-700/50">
                            {{-- The Image --}}
                            <img src="{{ asset('images/profile.jpg') }}" alt="Imran Ali" class="w-full h-full object-cover object-top transition-transform duration-500 group-hover:scale-110" onerror="this.src='{{ asset('images/img.jpeg') }}'; this.onerror=null;">
                        </div>
                    </div>

                    {{-- Available badge floating --}}
                    <div class="absolute -bottom-4 -left-4 sm:-bottom-6 sm:-left-8 z-20 glass py-2.5 px-4 sm:py-3 sm:px-5 rounded-full flex items-center gap-3 shadow-xl border border-white/10 transform transition-all duration-500 hover:scale-110 group-hover:-translate-y-2" style="backdrop-filter: blur(12px); background: rgba(17, 24, 39, 0.85);">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                        <span class="text-[11px] sm:text-sm font-bold text-white tracking-wide">Available</span>
                    </div>

                    {{-- floating tech badge --}}
                    <div class="absolute -top-4 -right-2 sm:-top-6 sm:-right-6 z-20 glass p-3 sm:p-4 rounded-full flex flex-col items-center justify-center shadow-xl border border-white/10 h-14 w-14 sm:h-20 sm:w-20 transform transition-all duration-500 hover:scale-110 group-hover:-translate-y-1 group-hover:translate-x-1" style="backdrop-filter: blur(12px); background: rgba(17, 24, 39, 0.85);">
                        <svg class="w-5 h-5 sm:w-8 sm:h-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- Scroll indicator --}}
        <div class="flex justify-center mt-16 fade-up" style="animation-delay:0.8s;">
            <a href="{{ url('/#about') }}" class="flex flex-col items-center gap-2 group">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color:#475569;">Scroll to explore</span>
                <div class="w-6 h-10 rounded-full flex items-start justify-center pt-2 transition-colors group-hover:border-cyan-400"
                     style="border:1px solid rgba(255,255,255,0.12);">
                    <div class="w-1.5 h-1.5 rounded-full" style="background:#00d4ff;animation:scrollBounce 1.4s infinite;"></div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ── ABOUT ─────────────────────────────────────────────────────── --}}
<section id="about" class="py-24 px-4 section-glow z-10 relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">Who I Am</span>
            <h2 class="section-title gradient-text-2 mt-2">About Me</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-16 items-start">
            {{-- Text --}}
            <div class="fade-up">
                <div class="space-y-5 text-lg leading-relaxed mb-10" style="color:#94a3b8;">
                    {!! $about_content->value ?? '
                    <p>Hello! I\'m <strong style="color:#e2e8f0;">Imran Ali</strong>, a results-driven full-stack web developer based in Rawalpindi, Pakistan, with a passion for building clean, scalable web applications.</p>
                    <p>With <strong style="color:#00d4ff;">3+ years</strong> of hands-on experience, I specialise in the <strong style="color:#e2e8f0;">Laravel ecosystem</strong> — from architecting robust backends and RESTful APIs to crafting responsive, accessible frontends.</p>
                    <p>I believe great software is equal parts engineering and empathy. Every line of code I write is guided by the question: <em style="color:#e2e8f0;">"Does this genuinely help the end user?"</em></p>
                    <p>When I\'m not coding, I\'m exploring new frameworks, contributing to open-source, or diving deep into system design concepts.</p>
                    ' !!}
                </div>

                {{-- Quick facts --}}
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['📍','Location','Punjab, Pakistan'],
                        ['💼','Status','Open to Work'],
                        ['🎓','Education','IT Graduate'],
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

{{-- ── SKILLS ─────────────────────────────────────────────────── --}}
<section id="skills" class="py-24 px-4 bg-[#050b14] z-10 relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">What I Know</span>
            <h2 class="section-title gradient-text-2 mt-2">Skills & Expertise</h2>
        </div>

        @forelse($skills as $category => $skillGroup)
            <div class="mb-16 fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <span class="section-label" style="margin-bottom:0;">{{ $category }}</span>
                    <div class="flex-1 h-px" style="background:rgba(255,255,255,0.06);"></div>
                </div>

                <div class="grid md:grid-cols-2 gap-5">
                    @foreach($skillGroup as $skill)
                    <div class="glass p-6 rounded-xl card-hover">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-semibold text-white">{{ $skill->name }}</span>
                            <span class="text-sm font-bold" style="color:#00d4ff;">{{ $skill->proficiency }}%</span>
                        </div>
                        <div class="skill-bar-track">
                            <div class="skill-bar-fill" style="width:{{ $skill->proficiency }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @empty
            {{-- Fallback demo skills --}}
            @foreach([
                ['Backend', [['Laravel',95],['PHP 8.x',90],['MySQL',88],['REST API',85]]],
                ['Frontend', [['JavaScript',80],['Tailwind CSS',92],['Vue.js',75],['Alpine.js',78]]],
                ['Tools & DevOps', [['Git & GitHub',90],['Docker',70],['Linux',75],['Composer',88]]],
            ] as [$cat,$items])
            <div class="mb-16 fade-up">
                <div class="flex items-center gap-4 mb-8">
                    <span class="section-label" style="margin-bottom:0;">{{ $cat }}</span>
                    <div class="flex-1 h-px" style="background:rgba(255,255,255,0.06);"></div>
                </div>
                <div class="grid md:grid-cols-2 gap-5">
                    @foreach($items as [$name,$pct])
                    <div class="glass p-6 rounded-xl card-hover">
                        <div class="flex justify-between items-center mb-3">
                            <span class="font-semibold text-white">{{ $name }}</span>
                            <span class="text-sm font-bold" style="color:#00d4ff;">{{ $pct }}%</span>
                        </div>
                        <div class="skill-bar-track">
                            <div class="skill-bar-fill" style="width:{{ $pct }}%;"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endforelse

        {{-- Tech cloud --}}
        <div class="text-center mt-8 fade-up">
            <div class="section-label mb-4">Also familiar with</div>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach(['Redis','Livewire','Inertia.js','PHPUnit','GitHub Actions','Nginx','Pusher / WebSockets','Stripe API','JWT','Eloquent ORM'] as $t)
                <span class="tech-pill">{{ $t }}</span>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── EXPERIENCE ────────────────────────────────────────────────── --}}
<section id="experience" class="py-24 px-4 section-glow z-10 relative">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">My Journey</span>
            <h2 class="section-title gradient-text-2 mt-2">Professional Experience</h2>
        </div>

        @forelse($experiences as $experience)
            <div class="relative flex gap-6 mb-12 fade-up">
                {{-- Timeline vertical --}}
                <div class="flex flex-col items-center">
                    <div class="timeline-dot mt-2"></div>
                    <div class="timeline-line mt-3"></div>
                </div>

                {{-- Content --}}
                <div class="glass card-hover p-7 rounded-2xl flex-1 mb-6">
                    <time class="text-xs font-bold uppercase tracking-widest mb-2 block" style="color:#00d4ff;">
                        {{ $experience->duration }}
                    </time>
                    <h2 class="text-xl font-black text-white mb-1">{{ $experience->job_title }}</h2>
                    <p class="font-semibold mb-4" style="color:#94a3b8;">{{ $experience->company }}</p>
                    <div class="text-sm leading-relaxed" style="color:#64748b;">
                        {!! nl2br(e($experience->description)) !!}
                    </div>
                </div>
            </div>
        @empty
            {{-- Fallback demo --}}
            @foreach([
                ['2023 – Present','Senior Laravel Developer','FreelanceHQ','Led development of 5+ client projects including e-commerce platforms and SaaS dashboards. Mentored junior developers and introduced CI/CD pipelines.'],
                ['2022 – 2023','Full-Stack Developer','WebCraft Studio','Built RESTful APIs and Vue.js frontends for 3 enterprise clients. Reduced page load times by 40% through caching strategies.'],
                ['2021 – 2022','Junior PHP Developer','TechStart PK','Developed and maintained PHP/Laravel applications. Implemented authentication, CRUD operations and reporting features.'],
            ] as [$dur,$role,$company,$desc])
            <div class="relative flex gap-6 mb-12 fade-up">
                <div class="flex flex-col items-center">
                    <div class="timeline-dot mt-2"></div>
                    <div class="timeline-line mt-3"></div>
                </div>
                <div class="glass card-hover p-7 rounded-2xl flex-1 mb-6">
                    <time class="text-xs font-bold uppercase tracking-widest mb-2 block" style="color:#00d4ff;">{{ $dur }}</time>
                    <h2 class="text-xl font-black text-white mb-1">{{ $role }}</h2>
                    <p class="font-semibold mb-4" style="color:#94a3b8;">{{ $company }}</p>
                    <p class="text-sm leading-relaxed" style="color:#64748b;">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        @endforelse
    </div>
</section>

{{-- ── PROJECTS ──────────────────────────────────────────────────── --}}
@if($projects->count())
<section id="projects" class="py-24 px-4 bg-[#050b14] z-10 relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">Portfolio</span>
            <h2 class="section-title gradient-text-2 mt-2">Featured Projects</h2>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <article class="glass card-hover project-card rounded-2xl overflow-hidden fade-up group">
                    <div class="relative aspect-video overflow-hidden" style="background:#111827;">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}" loading="lazy" class="project-img w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center relative">
                                <div class="blob blob-cyan" style="width:200px;height:200px;top:0;left:0;opacity:0.2;"></div>
                                <svg class="w-16 h-16 relative z-10" style="color:#1e293b;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                        <div class="project-overlay">
                            @if($project->link)
                            <a href="{{ $project->link }}" target="_blank" rel="noopener noreferrer" class="btn-primary text-xs py-2 px-4">Live Demo</a>
                            @endif
                        </div>
                    </div>
                    <div class="p-7">
                        <h2 class="text-xl font-bold text-white mb-2">{{ $project->title }}</h2>
                        <p class="text-sm leading-relaxed mb-5 line-clamp-2" style="color:#64748b;">{{ $project->description }}</p>
                        <div class="flex flex-wrap gap-2 mb-5">
                            @foreach(array_slice(explode(',', $project->tech_stack), 0, 3) as $tech)
                                <span class="tech-pill">{{ trim($tech) }}</span>
                            @endforeach
                            @if(count(explode(',', $project->tech_stack)) > 3) <span class="text-xs text-gray-500">...</span> @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── POSTS ─────────────────────────────────────────────────────── --}}
@if($posts->count())
<section id="posts" class="py-24 px-4 section-glow z-10 relative">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">Blog</span>
            <h2 class="section-title gradient-text-2 mt-2">Latest Insights</h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
                <article class="glass card-hover rounded-2xl overflow-hidden fade-up flex flex-col h-full group">
                    <div class="p-7 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="tech-pill text-xs">{{ $post->category ?? 'General' }}</span>
                            <span class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3 group-hover:text-cyan-400 transition-colors">
                            <a href="{{ route('posts.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>
                        <p class="text-sm leading-relaxed mb-6 flex-1 text-gray-400 line-clamp-3">
                            {{ Str::limit(strip_tags($post->content), 120) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="inline-flex items-center gap-2 text-sm font-semibold" style="color:#00d4ff;">
                            Read More
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ── CONTACT ───────────────────────────────────────────────────── --}}
<section id="contact" class="py-24 px-4 bg-[#050b14] z-10 relative">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">Say Hello</span>
            <h2 class="section-title gradient-text-2 mt-2">Get In Touch</h2>
        </div>

        <div class="grid lg:grid-cols-5 gap-12">
            {{-- Contact Info + Subscribe --}}
            <div class="lg:col-span-2 fade-up">
                {{-- Status Card --}}
                <div class="glass-strong p-6 rounded-2xl mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-3 h-3 rounded-full animate-pulse" style="background:#22c55e;"></span>
                        <span class="text-sm font-bold text-white">Available for work</span>
                    </div>
                    <p class="text-sm" style="color:#64748b;">
                        Currently accepting freelance projects and full-time remote positions. Response time: usually within 24 hours.
                    </p>
                </div>

                {{-- Contact Details --}}
                <div class="space-y-5 mb-10">
                    @foreach([
                        ['📧','Email','ranaimranali2210@gmail.com','mailto:ranaimranali2210@gmail.com'],
                        ['📍','Location','Rawalpindi, Pakistan',null],
                        ['⏰','Timezone','PKT (UTC+5)',null],
                    ] as [$icon,$label,$value,$href])
                    <div class="glass p-5 rounded-xl flex items-start gap-4">
                        <span class="text-2xl">{{ $icon }}</span>
                        <div>
                            <div class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#00d4ff;">{{ $label }}</div>
                            @if($href)
                                <a href="{{ $href }}" class="font-semibold text-white hover:text-cyan-400 transition-colors" style="color:#e2e8f0;">{{ $value }}</a>
                            @else
                                <div class="font-semibold text-white">{{ $value }}</div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Social Links --}}
                <div class="mb-10">
                    <div class="text-xs font-bold uppercase tracking-widest mb-4" style="color:#64748b;">Find me online</div>
                    <div class="space-y-3">
                        <a href="https://github.com/Rana-Imran-ali" target="_blank" rel="noopener noreferrer"
                           class="glass p-4 rounded-xl flex items-center gap-4 group hover:border-cyan-400 border border-transparent transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(0,212,255,0.12);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" style="color:#00d4ff;"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold uppercase tracking-widest" style="color:#64748b;">GitHub</div>
                                <div class="font-semibold text-white text-sm truncate group-hover:text-cyan-400 transition-colors">github.com/Rana-Imran-ali</div>
                            </div>
                        </a>
                        <a href="https://www.linkedin.com/in/rana-imran-ali" target="_blank" rel="noopener noreferrer"
                           class="glass p-4 rounded-xl flex items-center gap-4 group hover:border-blue-400 border border-transparent transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(10,102,194,0.18);">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" style="color:#0a66c2;"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="text-xs font-bold uppercase tracking-widest" style="color:#64748b;">LinkedIn</div>
                                <div class="font-semibold text-white text-sm truncate group-hover:text-blue-400 transition-colors">linkedin.com/in/rana-imran-ali</div>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Subscribe --}}
                <div id="subscribe" class="glass p-6 rounded-2xl scroll-m-24">
                    <div class="text-sm font-bold uppercase tracking-widest mb-2" style="color:#00d4ff;">📬 Newsletter</div>
                    <p class="text-xs leading-relaxed mb-4" style="color:#64748b;">
                        Get notified when I publish new posts or project updates.
                    </p>
                    <form action="{{ route('subscribe') }}" method="POST">
                        @csrf
                        <div class="flex flex-col gap-3">
                            <input type="email" name="email" required placeholder="your@email.com" class="input-field text-sm">
                            <button type="submit" class="btn-primary text-xs py-2.5 justify-center">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Contact Form --}}
            <div class="lg:col-span-3 fade-up" style="animation-delay:0.2s;">
                <div class="glass-strong p-8 rounded-2xl">
                    <h2 class="text-2xl font-black text-white mb-2">Send Me a Message</h2>
                    <p class="text-sm mb-8" style="color:#64748b;">Fill out the form below and I'll get back to you as soon as possible.</p>

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6" novalidate>
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-name">
                                    Full Name <span style="color:#ef4444;">*</span>
                                </label>
                                <input id="contact-name" type="text" name="name" required value="{{ old('name') }}" placeholder="Imran Ali" class="input-field @error('name') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-email">
                                    Email <span style="color:#ef4444;">*</span>
                                </label>
                                <input id="contact-email" type="email" name="email" required value="{{ old('email') }}" placeholder="your@email.com" class="input-field @error('email') border-red-500 @enderror">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-subject">Subject</label>
                            <input id="contact-subject" type="text" name="subject" value="{{ old('subject') }}" placeholder="Project Inquiry / Job Offer / Say Hi" class="input-field">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-message">
                                Message <span style="color:#ef4444;">*</span>
                            </label>
                            <textarea id="contact-message" name="message" rows="6" required placeholder="Tell me about your project, timeline, and budget..." class="input-field resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn-primary w-full justify-center text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Custom scroll bounce animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes scrollBounce {
            0%,100% { transform: translateY(0); opacity:1; }
            50%      { transform: translateY(10px); opacity:0.4; }
        }
        section { scroll-margin-top: 5rem; }
    `;
    document.head.appendChild(style);

    // Typewriter effect
    const words = ['Full-Stack Developer', 'Laravel Expert', 'PHP Engineer', 'API Architect'];
    let wi = 0, ci = 0, deleting = false;
    const el = document.getElementById('typewriter');
    function type() {
        if(!el) return;
        const word = words[wi];
        if (!deleting) {
            el.textContent = word.slice(0, ++ci);
            if (ci === word.length) { deleting = true; return setTimeout(type, 1800); }
        } else {
            el.textContent = word.slice(0, --ci);
            if (ci === 0) { deleting = false; wi = (wi+1) % words.length; }
        }
        setTimeout(type, deleting ? 60 : 100);
    }
    type();
</script>
@endpush
