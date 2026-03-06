@extends('layouts.frontend')

@section('title', 'Subscribe – Imran Developer')

@section('content')
<div class="min-h-screen py-32 px-4 relative flex items-center justify-center">
    {{-- Background elements --}}
    <div class="absolute inset-0 z-0">
        <div class="blob blob-cyan" style="width:500px;height:500px;top:20%;left:-100px;opacity:0.3;"></div>
        <div class="blob blob-purple" style="width:400px;height:400px;bottom:10%;right:-50px;opacity:0.3;"></div>
        <div class="absolute inset-0" style="background-image:linear-gradient(rgba(0,212,255,0.03) 1px, transparent 1px),linear-gradient(90deg,rgba(0,212,255,0.03) 1px, transparent 1px);background-size:40px 40px;"></div>
    </div>

    <div class="max-w-xl mx-auto w-full relative z-10 fade-up">
        <div class="glass-strong rounded-3xl p-8 md:p-12 shadow-2xl relative overflow-hidden">
            {{-- Top glow --}}
            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-cyan-500 to-purple-500"></div>

            <div class="text-center mb-10">
                <div class="w-16 h-16 mx-auto rounded-2xl flex items-center justify-center mb-6 shadow-lg" style="background:linear-gradient(135deg,#00d4ff,#7c3aed);">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
                <h1 class="text-3xl md:text-4xl font-black text-white mb-4 tracking-tight">Stay Updated</h1>
                <p class="text-base text-slate-400">Join the newsletter to get notified about my latest projects, articles, and development insights directly in your inbox.</p>
            </div>

            <form id="subscribe-page-form" action="{{ route('subscribe') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-slate-300 mb-2">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                        </div>
                        <input type="email" name="email" id="email" required placeholder="you@example.com" class="w-full bg-slate-900/50 border border-slate-700/50 rounded-xl pl-11 pr-4 py-4 text-white placeholder-slate-500 focus:outline-none focus:border-cyan-400 focus:ring-1 focus:ring-cyan-400 transition-all text-lg" autocomplete="email">
                    </div>
                    <p id="page-subscribe-error" class="text-red-400 text-sm mt-2 hidden"></p>
                </div>

                <button type="submit" id="page-subscribe-btn" class="w-full btn-primary justify-center font-bold text-lg py-4 shadow-[0_0_20px_rgba(0,212,255,0.3)] hover:shadow-[0_0_30px_rgba(0,212,255,0.5)] transition-shadow">
                    <svg id="page-subscribe-spinner" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span id="page-subscribe-btn-text">Subscribe Now</span>
                </button>
            </form>

            <div id="page-subscribe-success" class="hidden text-center py-8">
                <div class="w-16 h-16 mx-auto rounded-full bg-green-500/20 text-green-400 flex items-center justify-center mb-6 border border-green-500/30">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Awesome!</h3>
                <p class="text-slate-400 text-lg" id="page-subscribe-success-message">Please check your email to verify your subscription.</p>
                <a href="{{ route('home') }}" class="btn-outline mt-8 inline-flex">Return Home</a>
            </div>

            <p class="text-center text-xs text-slate-500 mt-8">I respect your privacy. No spam, ever. Unsubscribe at any time.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('subscribe-page-form');
        if(!form) return;

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const btn = document.getElementById('page-subscribe-btn');
            const btnText = document.getElementById('page-subscribe-btn-text');
            const spinner = document.getElementById('page-subscribe-spinner');
            const errorEl = document.getElementById('page-subscribe-error');
            
            btn.disabled = true;
            btnText.textContent = 'Subscribing...';
            spinner.classList.remove('hidden');
            errorEl.classList.add('hidden');
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: new FormData(form)
                });
                
                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Something went wrong. Please try again.');
                }
                
                form.classList.add('hidden');
                document.getElementById('page-subscribe-success').classList.remove('hidden');
                if (data.message) {
                    document.getElementById('page-subscribe-success-message').textContent = data.message;
                }
                
            } catch (error) {
                errorEl.textContent = error.message;
                errorEl.classList.remove('hidden');
                btn.disabled = false;
                btnText.textContent = 'Subscribe Now';
                spinner.classList.add('hidden');
            }
        });
    });
</script>
@endpush
