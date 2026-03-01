<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · Imran Developer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Admin overrides (scoped inside admin layout) ── */
        body { background:#0a0f1e; color:#e2e8f0; font-family:'Inter',sans-serif; }

        .admin-sidebar {
            width: 260px;
            background: rgba(255,255,255,0.03);
            border-right: 1px solid rgba(255,255,255,0.07);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .admin-nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .admin-nav-link:hover {
            color: #e2e8f0;
            background: rgba(255,255,255,0.05);
        }
        .admin-nav-link.active {
            color: #00d4ff;
            background: rgba(0,212,255,0.08);
            border: 1px solid rgba(0,212,255,0.15);
        }
        .admin-nav-link .icon { width:18px; height:18px; flex-shrink:0; }

        .admin-main {
            flex: 1;
            overflow-y: auto;
            padding: 2rem 2.5rem;
            background: #0a0f1e;
        }

        /* Table */
        .admin-table { width: 100%; border-collapse: collapse; }
        .admin-table th {
            padding: 0.75rem 1rem;
            text-align: left;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: #475569;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.04);
            font-size: 0.875rem;
            color: #94a3b8;
            vertical-align: middle;
        }
        .admin-table tr:hover td { background: rgba(255,255,255,0.02); }
        .admin-table td.font-semibold { color: #e2e8f0; font-weight: 600; }

        /* Form inputs (admin) */
        .admin-input {
            width: 100%;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            color: #e2e8f0;
            font-size: 0.875rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            font-family: inherit;
        }
        .admin-input::placeholder { color: #475569; }
        .admin-input:focus {
            border-color: #00d4ff;
            box-shadow: 0 0 0 3px rgba(0,212,255,0.1);
        }
        select.admin-input option { background: #0f1729; color: #e2e8f0; }

        /* Badges */
        .badge-green { background:rgba(34,197,94,0.1); color:#22c55e; border:1px solid rgba(34,197,94,0.2); padding:0.2rem 0.7rem; border-radius:99px; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; }
        .badge-gray  { background:rgba(100,116,139,0.1); color:#64748b; border:1px solid rgba(100,116,139,0.2); padding:0.2rem 0.7rem; border-radius:99px; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; }
        .badge-red   { background:rgba(239,68,68,0.1); color:#f87171; border:1px solid rgba(239,68,68,0.2); padding:0.2rem 0.7rem; border-radius:99px; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; }
        .badge-cyan  { background:rgba(0,212,255,0.08); color:#00d4ff; border:1px solid rgba(0,212,255,0.2); padding:0.2rem 0.7rem; border-radius:99px; font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.06em; }

        /* Page header */
        .admin-page-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem; flex-wrap:wrap; gap:1rem; }
        .admin-page-title  { font-size:1.75rem; font-weight:800; color:#fff; letter-spacing:-0.02em; }
        .admin-page-sub    { font-size:0.875rem; color:#475569; margin-top:0.25rem; }

        /* Flash alert */
        .flash-success { display:flex; align-items:center; gap:0.75rem; padding:0.875rem 1.25rem; border-radius:0.75rem; margin-bottom:1.5rem; font-size:0.875rem; font-weight:500; background:rgba(34,197,94,0.08); border:1px solid rgba(34,197,94,0.25); color:#22c55e; }
        .flash-error   { display:flex; align-items:center; gap:0.75rem; padding:0.875rem 1.25rem; border-radius:0.75rem; margin-bottom:1.5rem; font-size:0.875rem; font-weight:500; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.25); color:#f87171; }

        /* Card */
        .admin-card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.07); border-radius:1rem; }

        /* Stat card */
        .stat-card { background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.07); border-radius:1rem; padding:1.5rem; transition: border-color 0.2s, box-shadow 0.2s; }
        .stat-card:hover { border-color:rgba(0,212,255,0.2); box-shadow:0 8px 30px rgba(0,212,255,0.06); }
        .stat-number { font-size:2.5rem; font-weight:900; background:linear-gradient(135deg,#00d4ff,#a78bfa); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text; line-height:1; }
        .stat-label  { font-size:0.7rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:#475569; margin-top:0.5rem; }

        /* Btn delete (inline form) */
        .btn-delete { color:#f87171; font-size:0.8rem; font-weight:600; background:none; border:none; cursor:pointer; transition:color 0.2s; padding:0; }
        .btn-delete:hover { color:#ef4444; }
        .btn-edit { color:#00d4ff; font-size:0.8rem; font-weight:600; text-decoration:none; transition:color 0.2s; }
        .btn-edit:hover { color:#fff; }

        /* Sidebar toggle mobile */
        @media(max-width:768px){
            .admin-sidebar { display:none; }
            .admin-sidebar.open { display:flex; position:fixed; inset:0; z-index:50; width:260px; background:#0a0f1e; }
        }

        /* Label */
        .admin-label { display:block; font-size:0.7rem; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; color:#64748b; margin-bottom:0.5rem; }
    </style>
</head>
<body>
<div class="flex h-screen overflow-hidden">

    {{-- ══ SIDEBAR ══ --}}
    <aside class="admin-sidebar" id="adminSidebar">
        {{-- Brand --}}
        <div class="p-5 border-b" style="border-color:rgba(255,255,255,0.07);">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#00d4ff,#7c3aed);">
                    <span class="text-xs font-black text-white">ID</span>
                </div>
                <div>
                    <div class="text-sm font-bold text-white">Imran Developer</div>
                    <div class="text-xs" style="color:#475569;">Admin Panel</div>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto p-4">
            <div class="text-xs font-bold uppercase tracking-widest mb-3 px-3" style="color:#334155;">Main</div>

            @php
            $links = [
                ['admin.dashboard', route('admin.dashboard'), 'Dashboard', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>'],
                ['admin.projects.*', route('admin.projects.index'), 'Projects', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0l-4-4m4 4l-4 4M3 6h18M3 18h18"/>'],
                ['admin.skills.*', route('admin.skills.index'), 'Skills', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>'],
                ['admin.experience.*', route('admin.experience.index'), 'Experience', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>'],
                ['admin.posts.*', route('admin.posts.index'), 'Blog Posts', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                ['admin.content.*', route('admin.content.index'), 'Page Content', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>'],
                ['admin.messages.*', route('admin.messages.index'), 'Messages', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>'],
                ['admin.subscribers.*', route('admin.subscribers.index'), 'Subscribers', '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'],
            ];
            @endphp

            @foreach($links as [$routeName, $url, $label, $icon])
            <a href="{{ $url }}"
               class="admin-nav-link {{ request()->routeIs($routeName) ? 'active' : '' }}">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">{!! $icon !!}</svg>
                {{ $label }}
            </a>
            @endforeach

            <div class="mt-6 mb-3 px-3 text-xs font-bold uppercase tracking-widest" style="color:#334155;">Site</div>

            <a href="{{ route('home') }}" target="_blank" class="admin-nav-link">
                <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Live Site
            </a>
        </nav>

        {{-- User & Logout --}}
        <div class="p-4 border-t" style="border-color:rgba(255,255,255,0.07);">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-black" style="background:linear-gradient(135deg,#00d4ff20,#7c3aed20);border:1px solid rgba(0,212,255,0.2);color:#00d4ff;">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <div class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs" style="color:#475569;">Administrator</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="w-full flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors"
                        style="color:#64748b; background:rgba(239,68,68,0.05); border:1px solid rgba(239,68,68,0.1);"
                        onmouseover="this.style.color='#f87171'; this.style.borderColor='rgba(239,68,68,0.3)'"
                        onmouseout="this.style.color='#64748b'; this.style.borderColor='rgba(239,68,68,0.1)'">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- ══ MAIN ══ --}}
    <main class="admin-main" role="main">

        {{-- Mobile header --}}
        <div class="md:hidden flex items-center justify-between mb-6 pb-4" style="border-bottom:1px solid rgba(255,255,255,0.06);">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold text-white">Admin Panel</a>
            <button id="sidebarToggle" class="p-2 rounded-lg" style="border:1px solid rgba(255,255,255,0.1); color:#94a3b8;">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </div>

        {{-- Flash messages --}}
        @if(session('success'))
            <div class="flash-success">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="flash-error">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="flash-error">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                {{ $errors->first() }}
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    if (toggle && sidebar) {
        toggle.addEventListener('click', () => sidebar.classList.toggle('open'));
    }
</script>
</body>
</html>
