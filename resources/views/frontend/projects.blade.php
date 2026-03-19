@extends('layouts.frontend')

@section('title', 'Projects – Imran Developer')
@section('meta_description', 'View all the featured projects built using Laravel, PHP, MySQL, and Tailwind CSS by Imran Ali.')

@section('content')

{{-- ── HERO ─────────────────────────────────────────────────────── --}}
<section class="hero-bg relative pt-32 pb-20 flex items-center overflow-hidden min-h-[40vh]">
    <div class="blob blob-cyan" style="width:400px;height:400px;top:-100px;left:-50px;opacity:0.3;"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-up">
        <span class="section-label mb-4 mx-auto">Portfolio</span>
        <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight leading-[1.05] mb-6">
            <span class="text-white">All </span>
            <span class="gradient-text">Projects</span>
        </h1>
        <p class="text-base sm:text-lg leading-relaxed max-w-2xl mx-auto px-4" style="color:#64748b;">
            A showcase of my recent work, highlighting full-stack applications built using modern technologies.
        </p>
    </div>
</section>

{{-- ── PROJECTS GRID ──────────────────────────────────────────────────── --}}
<section class="py-24 px-4 bg-[#0a0f1e] z-10 relative" style="min-height: 50vh;">
    <div class="max-w-7xl mx-auto">
        @if($projects->count())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">
                @foreach($projects as $project)
                    <article class="glass card-hover project-card rounded-2xl overflow-hidden fade-up group" style="background: rgba(15,23,42,0.6);">
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
                            <p class="text-sm leading-relaxed mb-5 line-clamp-2" style="color:#94a3b8;">{{ $project->description }}</p>
                            <div class="flex flex-wrap gap-2 mb-5">
                                @foreach(array_slice(explode(',', $project->tech_stack), 0, 3) as $tech)
                                    <span class="tech-pill">{{ trim($tech) }}</span>
                                @endforeach
                                @if(count(explode(',', $project->tech_stack)) > 3) <span class="text-xs text-slate-500">...</span> @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 glass rounded-2xl max-w-2xl mx-auto fade-up">
                <svg class="w-16 h-16 mx-auto mb-4" style="color:#475569;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0l-7 7m7-7l-7-7"/>
                </svg>
                <h3 class="text-xl font-bold text-white mb-2">No Projects Found</h3>
                <p class="text-slate-400">Check back later for new updates to my portfolio.</p>
            </div>
        @endif
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
    `;
    document.head.appendChild(style);
</script>
@endpush
