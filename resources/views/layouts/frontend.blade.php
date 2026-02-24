<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO --}}
    <title>@yield('title', 'Imran Developer – Full-Stack Laravel Engineer')</title>
    <meta name="description" content="@yield('meta_description', 'Imran Ali is a full-stack web developer specializing in Laravel, PHP, MySQL and modern web technologies.')">
    <meta name="keywords"    content="@yield('meta_keywords', 'Laravel developer, PHP developer, full-stack, web developer, Imran Ali, portfolio')">
    <meta name="author"      content="Imran Ali">
    <meta name="robots"      content="index, follow">

    {{-- Open Graph --}}
    <meta property="og:title"       content="@yield('title', 'Imran Developer')">
    <meta property="og:description" content="@yield('meta_description', 'Full-stack Laravel developer.')">
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ url()->current() }}">
    <meta property="og:site_name"   content="Imran Developer">

    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')

    <style>
        /* Extra inline small utilities */
        .logo-glow { text-shadow: 0 0 20px rgba(0,212,255,0.4); }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-500 { animation-delay: 0.5s; }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .slide-down { animation: slideDown 0.4s ease forwards; }

        /* Mobile menu transition */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease;
        }
        #mobile-menu.open { max-height: 400px; }

        /* Navbar scroll effect handled via JS */
        .navbar.scrolled { box-shadow: 0 4px 30px rgba(0,0,0,0.4); }
    </style>
</head>
<body style="font-family:'Inter',sans-serif; background:#0a0f1e; color:#e2e8f0; overflow-x:hidden;">

    {{-- ═══════════════════════════════════════════════════ NAVBAR ══ --}}
    <nav id="navbar" class="navbar fixed top-0 inset-x-0 z-50 transition-all duration-300" role="navigation" aria-label="Main navigation">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 group" aria-label="Home">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#00d4ff,#7c3aed);">
                        <span class="text-sm font-black text-white">ID</span>
                    </div>
                    <span class="text-lg font-bold tracking-tight text-white group-hover:logo-glow transition-all">
                        Imran<span style="color:#00d4ff;">Developer</span>
                    </span>
                </a>

                {{-- Desktop menu --}}
                <div class="hidden md:flex items-center gap-1">
                    @foreach([
                        ['Home',       route('home')],
                        ['About',      route('about')],
                        ['Skills',     route('skills')],
                        ['Projects',   route('projects')],
                        ['Experience', route('experience')],
                        ['Contact',    route('contact')],
                    ] as [$label, $url])
                        <a href="{{ $url }}"
                           class="nav-link {{ request()->url() === $url ? 'active' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach

                    <a href="{{ route('resume') }}" class="btn-primary ml-4 text-xs py-2 px-5">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414A1 1 0 0119 9.414V19a2 2 0 01-2 2z"/></svg>
                        Resume
                    </a>
                </div>

                {{-- Mobile hamburger --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg transition-colors"
                        style="border:1px solid rgba(255,255,255,0.07); color:#94a3b8;"
                        aria-label="Toggle menu" aria-expanded="false">
                    <svg id="icon-open"  class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="icon-close" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>

        {{-- Mobile dropdown --}}
        <div id="mobile-menu" style="border-top:1px solid rgba(255,255,255,0.06); background:rgba(10,15,30,0.98);">
            <div class="px-4 py-4 space-y-1">
                @foreach([
                    ['Home',       route('home')],
                    ['About',      route('about')],
                    ['Skills',     route('skills')],
                    ['Projects',   route('projects')],
                    ['Experience', route('experience')],
                    ['Contact',    route('contact')],
                ] as [$label, $url])
                    <a href="{{ $url }}"
                       class="block px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                              {{ request()->url() === $url
                                 ? 'text-white' : 'text-slate-400 hover:text-white' }}"
                       style="{{ request()->url() === $url ? 'background:rgba(0,212,255,0.08); color:#00d4ff;' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
                <a href="{{ route('resume') }}" class="block px-3 py-2.5 text-sm font-semibold" style="color:#00d4ff;">
                    ↓ Download Resume
                </a>
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════ FLASH ALERTS ══ --}}
    <div class="max-w-7xl mx-auto px-4 pt-20">
        @if(session('success'))
            <div class="slide-down mt-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium"
                 style="background:rgba(0,212,255,0.08); border:1px solid rgba(0,212,255,0.25); color:#00d4ff;">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error') || $errors->any())
            <div class="slide-down mt-4 flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium"
                 style="background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.25); color:#f87171;">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') ?? $errors->first() }}
            </div>
        @endif
    </div>

    {{-- ═══════════════════════════════════════════════════ CONTENT ══ --}}
    <main class="min-h-screen" role="main">
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════════ FOOTER ══ --}}
    <footer class="footer-gradient mt-24" role="contentinfo">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid md:grid-cols-3 gap-12 mb-12">

                {{-- Brand --}}
                <div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#00d4ff,#7c3aed);">
                            <span class="text-sm font-black text-white">ID</span>
                        </div>
                        <span class="text-lg font-bold text-white">Imran<span style="color:#00d4ff;">Developer</span></span>
                    </a>
                    <p class="text-sm leading-relaxed mb-6" style="color:#64748b;">
                        Full-stack web developer crafting robust Laravel & PHP applications with a passion for clean code and great UX.
                    </p>
                    {{-- Social links --}}
                    <div class="flex gap-3">
                        <a href="#" class="social-btn" aria-label="GitHub">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                        </a>
                        <a href="#" class="social-btn" aria-label="LinkedIn">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="mailto:hello@imran.com" class="social-btn" aria-label="Email">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest mb-5" style="color:#00d4ff;">Navigation</h3>
                    <ul class="space-y-3">
                        @foreach([
                            ['Home',       route('home')],
                            ['About',      route('about')],
                            ['Skills',     route('skills')],
                            ['Projects',   route('projects')],
                            ['Experience', route('experience')],
                            ['Contact',    route('contact')],
                        ] as [$label, $url])
                            <li>
                                <a href="{{ $url }}" class="text-sm transition-colors hover:text-white"
                                   style="color:#64748b;">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest mb-5" style="color:#00d4ff;">Get In Touch</h3>
                    <div class="space-y-4 text-sm" style="color:#64748b;">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 flex-shrink-0" style="color:#00d4ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:hello@imran.com" class="hover:text-white transition-colors">hello@imran.com</a>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 flex-shrink-0" style="color:#00d4ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Rawalpindi, Pakistan</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 flex-shrink-0" style="color:#00d4ff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span style="color:#00d4ff; font-weight:600;">Available for hire</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom bar --}}
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-8" style="border-top:1px solid rgba(255,255,255,0.05);">
                <p class="text-xs" style="color:#475569;">
                    &copy; {{ date('Y') }} Imran Developer. Crafted with ❤️ in Laravel.
                </p>
                <p class="text-xs" style="color:#475569;">
                    Laravel · PHP · MySQL · Tailwind CSS
                </p>
            </div>
        </div>
    </footer>

    {{-- ═══════════════════════════════ SCRIPTS ══ --}}
    <script>
        // Mobile menu
        const btn  = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const openI  = document.getElementById('icon-open');
        const closeI = document.getElementById('icon-close');
        btn.addEventListener('click', function() {
            const isOpen = menu.classList.contains('open');
            menu.classList.toggle('open');
            openI.classList.toggle('hidden');
            closeI.classList.toggle('hidden');
            btn.setAttribute('aria-expanded', !isOpen);
        });

        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 30);
        });

        // Scroll fade-in observer
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('visible');
                    observer.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
    </script>

    @stack('scripts')
</body>
</html>
