@extends('layouts.frontend')

@section('title', 'Imran Developer – Laravel & PHP Full-Stack Engineer')
@section('meta_description', 'Welcome to the portfolio of Imran Ali, a full-stack web developer specialising in Laravel, PHP, MySQL and Tailwind CSS. Available for freelance and full-time positions.')
@section('meta_keywords', 'Laravel developer, PHP developer, Imran Ali, full-stack developer, portfolio, hire developer')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section class="hero-bg relative min-h-screen flex items-center overflow-hidden">

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
                    <a href="{{ route('projects') }}" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-7 7m7-7l-7-7"/></svg>
                        View My Work
                    </a>
                    <a href="{{ route('contact') }}" class="btn-outline">
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

            {{-- Right — code card --}}
            <div class="lg:col-span-5 fade-up" style="animation-delay:0.4s;">
                <div class="glass-strong p-6 rounded-2xl card-hover relative">
                    {{-- Terminal header --}}
                    <div class="flex items-center gap-2 mb-5 pb-4" style="border-bottom:1px solid rgba(255,255,255,0.06);">
                        <span class="w-3 h-3 rounded-full" style="background:#ef4444;"></span>
                        <span class="w-3 h-3 rounded-full" style="background:#f59e0b;"></span>
                        <span class="w-3 h-3 rounded-full" style="background:#22c55e;"></span>
                        <span class="ml-3 text-xs font-mono" style="color:#475569;">imran@portfolio:~$</span>
                    </div>
                    {{-- Code content --}}
                    <pre class="font-mono text-sm leading-relaxed" style="color:#e2e8f0;">
<span style="color:#94a3b8;">// Developer Profile</span>
<span style="color:#7c3aed;">const</span> <span style="color:#00d4ff;">imran</span> = {
  name:    <span style="color:#a78bfa;">"Imran Ali"</span>,
  role:    <span style="color:#a78bfa;">"Full-Stack Developer"</span>,
  location:<span style="color:#a78bfa;">"Rawalpindi, PK"</span>,

  stack: [
    <span style="color:#a78bfa;">"Laravel"</span>, <span style="color:#a78bfa;">"PHP"</span>,
    <span style="color:#a78bfa;">"MySQL"</span>, <span style="color:#a78bfa;">"Vue.js"</span>,
    <span style="color:#a78bfa;">"Tailwind"</span>, <span style="color:#a78bfa;">"REST API"</span>
  ],

  available: <span style="color:#22c55e;">true</span>,
  coffee:    <span style="color:#f59e0b;">Infinity</span> ☕
};</pre>

                    {{-- Available badge --}}
                    <div class="mt-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full animate-pulse" style="background:#22c55e;"></span>
                        <span class="text-xs font-semibold" style="color:#22c55e;">Online & Ready to Work</span>
                    </div>
                </div>
            </div>

        </div>

        {{-- Scroll indicator --}}
        <div class="flex justify-center mt-16 fade-up" style="animation-delay:0.8s;">
            <a href="{{ route('about') }}" class="flex flex-col items-center gap-2 group">
                <span class="text-xs font-semibold uppercase tracking-widest" style="color:#475569;">Scroll to explore</span>
                <div class="w-6 h-10 rounded-full flex items-start justify-center pt-2 transition-colors group-hover:border-cyan-400"
                     style="border:1px solid rgba(255,255,255,0.12);">
                    <div class="w-1.5 h-1.5 rounded-full" style="background:#00d4ff;animation:scrollBounce 1.4s infinite;"></div>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- ── WHAT I DO ─────────────────────────────────────────────────── --}}
<section class="section-glow py-24 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 fade-up">
            <span class="section-label">What I Do</span>
            <h2 class="section-title gradient-text-2 mt-2">My Core Services</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
                ['🔧','Backend Development','Building robust server-side applications with Laravel & PHP, including RESTful APIs, authentication and database design.'],
                ['🎨','Frontend Development','Crafting responsive, pixel-perfect UIs with Tailwind CSS, Vue.js and Alpine.js that delight users on any device.'],
                ['🛒','E-Commerce Solutions','Full-featured online stores with cart, checkout, payment gateway integration and admin dashboards.'],
                ['🗄️','Database Architecture','Optimising schemas, writing efficient queries and managing migrations for MySQL & PostgreSQL.'],
                ['⚡','Performance & Security','Code profiling, caching strategies, security hardening and best-practice deployment pipelines.'],
                ['📱','API Development','Designing and building clean, well-documented RESTful and GraphQL APIs for web and mobile clients.'],
            ] as [$icon,$title,$desc])
            <div class="glass card-hover p-7 fade-up">
                <div class="text-3xl mb-4">{{ $icon }}</div>
                <h3 class="text-lg font-bold text-white mb-3">{{ $title }}</h3>
                <p class="text-sm leading-relaxed" style="color:#64748b;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── QUICK TECH STACK ───────────────────────────────────────────── --}}
<section class="py-20 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12 fade-up">
            <span class="section-label">Tech Stack</span>
            <h2 class="section-title gradient-text-2 mt-2">Tools I Work With</h2>
        </div>
        <div class="flex flex-wrap justify-center gap-3 fade-up">
            @foreach($skills as $skill)
            <span class="tech-pill text-base px-5 py-2.5" style="font-size:0.8rem;">{{ $skill->name }}</span>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CTA BANNER ─────────────────────────────────────────────────── --}}
<section class="py-20 px-4">
    <div class="max-w-4xl mx-auto fade-up">
        <div class="glass-strong rounded-3xl p-12 text-center relative overflow-hidden">
            <div class="blob blob-cyan" style="width:400px;height:400px;top:-150px;left:50%;transform:translateX(-50%);opacity:0.5;"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                    Have a project in mind?
                </h2>
                <p class="text-lg mb-8" style="color:#64748b;">
                    Let's build something great together. I'm available for freelance, remote, and on-site roles.
                </p>
                <a href="{{ route('contact') }}" class="btn-primary mx-auto" style="width:fit-content;">
                    Start a Conversation
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ── RECENT PROJECTS ────────────────────────────────────────────── --}}
@if($projects->count())
<section class="py-24 px-4 bg-[#050b14]">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-16 fade-up">
            <div>
                <span class="section-label">Portfolio</span>
                <h2 class="section-title gradient-text mt-2">Recent Work</h2>
            </div>
            <a href="{{ route('projects') }}" class="hidden md:inline-flex items-center gap-2 text-sm font-semibold transition-colors hover:text-white" style="color:#00d4ff;">
                View All Projects
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
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
        <div class="mt-12 text-center md:hidden fade-up" style="animation-delay:0.3s;">
             <a href="{{ route('projects') }}" class="btn-outline">View All Projects</a>
        </div>
    </div>
</section>
@endif

{{-- ── RECENT POSTS ───────────────────────────────────────────────── --}}
@if($posts->count())
<section class="py-24 px-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-end mb-16 fade-up">
            <div>
                <span class="section-label">Blog</span>
                <h2 class="section-title gradient-text-2 mt-2">Latest Insights</h2>
            </div>
            <a href="{{ route('posts') }}" class="hidden md:inline-flex items-center gap-2 text-sm font-semibold transition-colors hover:text-white" style="color:#00d4ff;">
                Read All Articles
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
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
        <div class="mt-12 text-center md:hidden fade-up" style="animation-delay:0.3s;">
             <a href="{{ route('posts') }}" class="btn-outline">Read All Articles</a>
        </div>
    </div>
</section>
@endif

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
    `;
    document.head.appendChild(style);

    // Typewriter effect
    const words = ['Full-Stack Developer', 'Laravel Expert', 'PHP Engineer', 'API Architect'];
    let wi = 0, ci = 0, deleting = false;
    const el = document.getElementById('typewriter');
    function type() {
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
