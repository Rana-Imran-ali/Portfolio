@extends('layouts.frontend')

@section('title', 'Contact – Imran Developer')
@section('meta_description', 'Get in touch with Imran Ali for freelance projects, job opportunities, or just to say hello.')

@section('content')
<div class="pt-20">

    {{-- ── HEADER ───────────────────────────────────────────────── --}}
    <section class="hero-bg py-20 px-4 relative overflow-hidden">
        <div class="blob blob-cyan" style="width:400px;height:400px;top:-50px;left:-80px;opacity:0.35;"></div>
        <div class="max-w-7xl mx-auto text-center">
            <span class="section-label fade-up">Say Hello</span>
            <h1 class="section-title gradient-text-2 mt-2 fade-up" style="animation-delay:0.1s;">Get In Touch</h1>
            <p class="mt-4 text-lg max-w-xl mx-auto fade-up" style="color:#64748b;animation-delay:0.2s;">
                I'm always open to new projects, creative ideas and opportunities. Let's build something great together!
            </p>
        </div>
    </section>

    {{-- ── MAIN CONTENT ─────────────────────────────────────────── --}}
    <section class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid lg:grid-cols-5 gap-12">

                {{-- ── LEFT: Contact Info + Subscribe ──────────── --}}
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

                    {{-- Social / Connect Links --}}
                    <div class="mb-10">
                        <div class="text-xs font-bold uppercase tracking-widest mb-4" style="color:#64748b;">Find me online</div>
                        <div class="space-y-3">

                            {{-- GitHub --}}
                            <a href="https://github.com/Rana-Imran-ali" target="_blank" rel="noopener noreferrer"
                               class="glass p-4 rounded-xl flex items-center gap-4 group hover:border-cyan-400 border border-transparent transition-all duration-300">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(0,212,255,0.12);">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" style="color:#00d4ff;"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold uppercase tracking-widest" style="color:#64748b;">GitHub</div>
                                    <div class="font-semibold text-white text-sm truncate group-hover:text-cyan-400 transition-colors">github.com/Rana-Imran-ali</div>
                                </div>
                                <svg class="w-4 h-4 flex-shrink-0 opacity-40 group-hover:opacity-100 group-hover:text-cyan-400 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>

                            {{-- LinkedIn --}}
                            <a href="https://www.linkedin.com/in/rana-imran-ali" target="_blank" rel="noopener noreferrer"
                               class="glass p-4 rounded-xl flex items-center gap-4 group hover:border-blue-400 border border-transparent transition-all duration-300">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(10,102,194,0.18);">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" style="color:#0a66c2;"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold uppercase tracking-widest" style="color:#64748b;">LinkedIn</div>
                                    <div class="font-semibold text-white text-sm truncate group-hover:text-blue-400 transition-colors">linkedin.com/in/rana-imran-ali</div>
                                </div>
                                <svg class="w-4 h-4 flex-shrink-0 opacity-40 group-hover:opacity-100 group-hover:text-blue-400 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>

                            {{-- Email --}}
                            <a href="mailto:ranaimranali2210@gmail.com"
                               class="glass p-4 rounded-xl flex items-center gap-4 group hover:border-rose-400 border border-transparent transition-all duration-300">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(239,68,68,0.12);">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="color:#f87171;"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-xs font-bold uppercase tracking-widest" style="color:#64748b;">Email</div>
                                    <div class="font-semibold text-white text-sm truncate group-hover:text-rose-400 transition-colors">ranaimranali2210@gmail.com</div>
                                </div>
                                <svg class="w-4 h-4 flex-shrink-0 opacity-40 group-hover:opacity-100 group-hover:text-rose-400 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>

                        </div>
                    </div>

                    {{-- Subscribe --}}
                    <div class="glass p-6 rounded-2xl">
                        <div class="text-sm font-bold uppercase tracking-widest mb-2" style="color:#00d4ff;">📬 Newsletter</div>
                        <p class="text-xs leading-relaxed mb-4" style="color:#64748b;">
                            Get notified when I publish new posts or project updates.
                        </p>
                        <form action="{{ route('subscribe') }}" method="POST">
                            @csrf
                            <div class="flex flex-col gap-3">
                                <input type="email" name="email" required
                                       placeholder="your@email.com"
                                       class="input-field text-sm">
                                <button type="submit" class="btn-primary text-xs py-2.5 justify-center">
                                    Subscribe
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── RIGHT: Contact Form ───────────────────── --}}
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
                                    <input id="contact-name" type="text" name="name" required
                                           value="{{ old('name') }}"
                                           placeholder="Imran Ali"
                                           class="input-field @error('name') border-red-500 @enderror">
                                    @error('name')
                                    <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-email">
                                        Email <span style="color:#ef4444;">*</span>
                                    </label>
                                    <input id="contact-email" type="email" name="email" required
                                           value="{{ old('email') }}"
                                           placeholder="your@email.com"
                                           class="input-field @error('email') border-red-500 @enderror">
                                    @error('email')
                                    <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-subject">
                                    Subject
                                </label>
                                <input id="contact-subject" type="text" name="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="Project Inquiry / Job Offer / Say Hi"
                                       class="input-field">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest mb-2" style="color:#94a3b8;" for="contact-message">
                                    Message <span style="color:#ef4444;">*</span>
                                </label>
                                <textarea id="contact-message" name="message" rows="6" required
                                          placeholder="Tell me about your project, timeline, and budget..."
                                          class="input-field resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="text-xs mt-1" style="color:#f87171;">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn-primary w-full justify-center text-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Message
                            </button>

                            <p class="text-xs text-center" style="color:#475569;">
                                I typically respond within 24 hours. No spam — ever.
                            </p>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
@endsection
