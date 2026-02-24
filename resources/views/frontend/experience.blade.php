@extends('layouts.frontend')

@section('title', 'Experience – Imran Developer')
@section('meta_description', 'View the professional work history of Imran Ali, including past roles, companies, and the impact delivered.')

@section('content')
<div class="pt-20">

    {{-- ── HEADER ───────────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-purple" style="width:400px;height:400px;top:-80px;right:-80px;opacity:0.4;"></div>
        <div class="max-w-7xl mx-auto text-center">
            <span class="section-label fade-up">My Journey</span>
            <h1 class="section-title gradient-text-2 mt-2 fade-up" style="animation-delay:0.1s;">Professional Experience</h1>
            <p class="mt-4 text-lg max-w-xl mx-auto fade-up" style="color:#64748b;animation-delay:0.2s;">
                A timeline of my professional journey and the impact I've made.
            </p>
        </div>
    </section>

    {{-- ── TIMELINE ────────────────────────────────────────────── --}}
    <section class="py-24 px-4">
        <div class="max-w-3xl mx-auto">

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

    {{-- ── CTA ──────────────────────────────────────────────────── --}}
    <section class="pb-20 px-4">
        <div class="max-w-2xl mx-auto text-center fade-up">
            <p class="text-lg mb-6" style="color:#64748b;">Want to see my full work history?</p>
            <a href="{{ route('resume') }}" class="btn-primary mx-auto" style="width:fit-content;">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/></svg>
                Download Resume
            </a>
        </div>
    </section>

</div>
@endsection
