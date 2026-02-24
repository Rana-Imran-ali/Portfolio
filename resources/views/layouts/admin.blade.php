<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Dashboard - Imran Developer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-black font-sans antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white shrink-0 overflow-y-auto">
            <div class="p-6">
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold tracking-tighter">Admin Panel</a>
            </div>
            <nav class="mt-6 px-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.projects.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.projects.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Projects
                </a>
                <a href="{{ route('admin.skills.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.skills.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Skills
                </a>
                <a href="{{ route('admin.experience.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.experience.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Experience
                </a>
                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.posts.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Posts
                </a>
                <a href="{{ route('admin.subscribers.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.subscribers.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Subscribers
                </a>
                <a href="{{ route('admin.content.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-md {{ request()->routeIs('admin.content.*') ? 'bg-gray-800' : 'hover:bg-gray-900' }}">
                    Page Content
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-4 border-t border-gray-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm font-medium text-gray-400 hover:text-white transition-colors uppercase tracking-widest leading-none">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-white p-10">
            @if(session('success'))
                <div class="mb-8 p-4 bg-black text-white rounded-md text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
