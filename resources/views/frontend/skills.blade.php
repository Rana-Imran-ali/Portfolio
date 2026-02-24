@extends('layouts.frontend')

@section('title', 'Skills & Expertise – Imran Developer')
@section('meta_description', 'Explore the technical skills of Imran Ali including Laravel, PHP, JavaScript, MySQL, Tailwind CSS and more.')

@section('content')
<div class="pt-20">

    {{-- ── HEADER ───────────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-purple" style="width:500px;height:500px;top:-100px;left:-100px;opacity:0.4;"></div>
        <div class="max-w-7xl mx-auto text-center">
            <span class="section-label fade-up">What I Know</span>
            <h1 class="section-title gradient-text-2 mt-2 fade-up" style="animation-delay:0.1s;">Skills & Expertise</h1>
            <p class="mt-4 text-lg max-w-xl mx-auto fade-up" style="color:#64748b;animation-delay:0.2s;">
                Technologies and tools I use to build powerful, scalable web applications.
            </p>
        </div>
    </section>

    {{-- ── SKILLS GRID ─────────────────────────────────────────── --}}
    <section class="py-24 px-4">
        <div class="max-w-7xl mx-auto">

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
</div>
@endsection
