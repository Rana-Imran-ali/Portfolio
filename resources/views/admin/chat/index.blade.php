@extends('layouts.admin')

@section('title', 'Live Chat')

@section('content')
<div class="admin-page-header">
    <div>
        <h1 class="admin-page-title">Live Chat</h1>
        <p class="admin-page-sub">Real-time conversations with your website visitors.</p>
    </div>
</div>

{{-- ── Two-pane chat UI ─────────────────────────────────────────────── --}}
<div class="admin-card overflow-hidden" style="display:flex;height:calc(100vh - 220px);min-height:400px;">

    {{-- LEFT PANE: Session list --}}
    <div id="session-list" style="width:280px;flex-shrink:0;border-right:1px solid rgba(255,255,255,0.07);display:flex;flex-direction:column;">
        <div style="padding:.75rem 1rem;font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#334155;border-bottom:1px solid rgba(255,255,255,.06);">
            Active Sessions
        </div>
        <div id="sessions-container" style="flex:1;overflow-y:auto;">
            @forelse($sessions as $session)
            <button class="session-item" data-sid="{{ $session->session_id }}" aria-label="Open chat with {{ $session->name ?? 'Visitor' }}">
                <div class="session-avatar">{{ strtoupper(substr($session->name ?? 'V', 0, 1)) }}</div>
                <div class="session-info">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <span class="session-name">{{ $session->name ?? 'Visitor' }}</span>
                        @if($session->status === 'closed')
                            <span class="badge-gray" style="font-size:.55rem;padding:.1rem .45rem;">Closed</span>
                        @else
                            <span class="badge-green" style="font-size:.55rem;padding:.1rem .45rem;">Active</span>
                        @endif
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:.2rem;">
                        <span class="session-preview">{{ $session->latestMessage?->message ? Str::limit($session->latestMessage->message, 28) : 'No messages yet' }}</span>
                        @if($session->unread_by_admin > 0)
                            <span class="session-unread-badge">{{ $session->unread_by_admin }}</span>
                        @endif
                    </div>
                    <div class="session-time">{{ $session->last_message_at?->diffForHumans() ?? $session->created_at->diffForHumans() }}</div>
                </div>
            </button>
            @empty
            <div style="padding:2rem 1rem;text-align:center;color:#475569;font-size:.8rem;">
                No chat sessions yet.<br>Visitors can start a chat from your website.
            </div>
            @endforelse
        </div>
    </div>

    {{-- RIGHT PANE: Active conversation --}}
    <div id="chat-pane" style="flex:1;display:flex;flex-direction:column;min-width:0;">

        {{-- Empty state --}}
        <div id="chat-pane-empty" style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;color:#475569;">
            <svg style="width:3rem;height:3rem;margin-bottom:1rem;color:#334155;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
            </svg>
            <p style="font-size:.875rem;">Select a conversation to start chatting</p>
        </div>

        {{-- Conversation area (hidden until a session is selected) --}}
        <div id="chat-pane-conversation" style="display:none;flex:1;flex-direction:column;min-height:0;">

            {{-- Header --}}
            <div id="admin-chat-header" style="display:flex;align-items:center;justify-content:space-between;padding:.75rem 1rem;border-bottom:1px solid rgba(255,255,255,.06);">
                <div style="display:flex;align-items:center;gap:.75rem;">
                    <div id="admin-chat-avatar" style="width:2.25rem;height:2.25rem;border-radius:50%;background:linear-gradient(135deg,#00d4ff,#7c3aed);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:.75rem;color:#fff;">?</div>
                    <div>
                        <div id="admin-chat-name" style="font-weight:700;color:#e2e8f0;font-size:.875rem;"></div>
                        <div id="admin-chat-email" style="font-size:.72rem;color:#475569;"></div>
                    </div>
                </div>
                <button id="admin-close-chat" style="font-size:.75rem;font-weight:600;background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.2);color:#f87171;padding:.35rem .8rem;border-radius:.4rem;cursor:pointer;transition:all .15s;">
                    Close Session
                </button>
            </div>

            {{-- Messages --}}
            <div id="admin-messages" style="flex:1;overflow-y:auto;padding:1rem 1.25rem;display:flex;flex-direction:column;gap:.4rem;scroll-behavior:smooth;">
            </div>

            {{-- Reply form --}}
            <form id="admin-reply-form" style="display:flex;gap:.6rem;padding:.75rem 1rem;border-top:1px solid rgba(255,255,255,.06);">
                <textarea id="admin-reply-input"
                          rows="1"
                          placeholder="Type a reply…"
                          maxlength="2000"
                          style="flex:1;background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:.5rem;color:#e2e8f0;font-size:.875rem;padding:.55rem .75rem;resize:none;outline:none;transition:border-color .15s;font-family:inherit;max-height:96px;overflow-y:auto;"
                          aria-label="Reply input"></textarea>
                <button type="submit"
                        style="display:flex;align-items:center;gap:.4rem;padding:.55rem 1.1rem;border-radius:.5rem;border:none;cursor:pointer;font-size:.84rem;font-weight:600;background:linear-gradient(135deg,#00d4ff,#7c3aed);color:#fff;transition:opacity .15s;"
                        aria-label="Send reply">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1rem;height:1rem;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Send
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* Session list items */
.session-item {
    display: flex; align-items: flex-start; gap: .65rem;
    width: 100%;
    padding: .75rem .85rem;
    text-align: left;
    background: none; border: none; cursor: pointer;
    border-bottom: 1px solid rgba(255,255,255,.04);
    transition: background .15s;
    color: inherit;
}
.session-item:hover, .session-item.active {
    background: rgba(0,212,255,.05);
}
.session-item.active { border-left: 2px solid #00d4ff; }
.session-avatar {
    width: 2rem; height: 2rem; flex-shrink: 0;
    border-radius: 50%;
    background: linear-gradient(135deg,#00d4ff22,#7c3aed33);
    border: 1px solid rgba(0,212,255,.2);
    display: flex; align-items: center; justify-content: center;
    font-size: .72rem; font-weight: 800; color: #00d4ff;
}
.session-info { flex: 1; min-width: 0; }
.session-name { font-size: .82rem; font-weight: 600; color: #e2e8f0; }
.session-preview { font-size: .72rem; color: #475569; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px; }
.session-time { font-size: .65rem; color: #334155; margin-top: .2rem; }
.session-unread-badge {
    min-width: 1.1rem; height: 1.1rem;
    padding: 0 .3rem;
    background: #00d4ff;
    border-radius: 99px;
    font-size: .6rem; font-weight: 700; color: #0a0f1e;
    display: flex; align-items: center; justify-content: center;
}

/* Admin bubble styles (shared with widget CSS) */
.admin-bubble-wrap { display: flex; flex-direction: column; max-width: 70%; }
.admin-bubble-wrap.client { align-self: flex-start; align-items: flex-start; }
.admin-bubble-wrap.admin  { align-self: flex-end; align-items: flex-end; }
.admin-bubble {
    padding: .55rem .85rem; border-radius: 1rem;
    font-size: .875rem; line-height: 1.45; word-break: break-word;
}
.admin-bubble.client {
    background: rgba(255,255,255,.06); border: 1px solid rgba(255,255,255,.08);
    color: #cbd5e1; border-bottom-left-radius: .2rem;
}
.admin-bubble.admin {
    background: linear-gradient(135deg,#00d4ff18,#7c3aed22);
    border: 1px solid rgba(0,212,255,.18);
    color: #e2e8f0; border-bottom-right-radius: .2rem;
}
.admin-bubble-meta { font-size: .65rem; color: #475569; margin-top: .15rem; display: flex; align-items: center; gap: .3rem; }
.admin-date-sep { text-align:center; font-size:.65rem; color:#334155; margin:.4rem 0; }
</style>

@endsection

@push('scripts')
<script>
// Admin-side Echo + Chat logic (vanilla JS, no module bundler)
(function() {
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    let currentSessionId = null;
    let echoChannel      = null;

    const sessionBtns   = document.querySelectorAll('.session-item');
    const msgsEl        = document.getElementById('admin-messages');
    const replyForm     = document.getElementById('admin-reply-form');
    const replyInput    = document.getElementById('admin-reply-input');
    const paneEmpty     = document.getElementById('chat-pane-empty');
    const paneConv      = document.getElementById('chat-pane-conversation');
    const headerName    = document.getElementById('admin-chat-name');
    const headerEmail   = document.getElementById('admin-chat-email');
    const headerAvatar  = document.getElementById('admin-chat-avatar');
    const closeBtn      = document.getElementById('admin-close-chat');

    // ── Helpers ───────────────────────────────────────────────────────
    function formatTime(iso) {
        return new Date(iso).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    function formatDate(iso) {
        const d = new Date(iso), t = new Date();
        const y = new Date(t); y.setDate(t.getDate() - 1);
        if (d.toDateString() === t.toDateString()) return 'Today';
        if (d.toDateString() === y.toDateString()) return 'Yesterday';
        return d.toLocaleDateString([], { month: 'short', day: 'numeric' });
    }
    function scrollDown() { msgsEl.scrollTop = msgsEl.scrollHeight; }

    function appendMsg(msg, prevDate) {
        const dateStr = formatDate(msg.created_at);
        if (dateStr !== prevDate) {
            const sep = document.createElement('div');
            sep.className = 'admin-date-sep';
            sep.textContent = dateStr;
            msgsEl.appendChild(sep);
        }
        const isAdmin = msg.sender_type === 'admin';
        const wrap = document.createElement('div');
        wrap.className = `admin-bubble-wrap ${isAdmin ? 'admin' : 'client'}`;
        wrap.innerHTML = `
            <div class="admin-bubble ${isAdmin ? 'admin' : 'client'}">${escapeHtml(msg.message)}</div>
            <div class="admin-bubble-meta">
                <span>${isAdmin ? 'You' : 'Visitor'}</span>
                <span>${formatTime(msg.created_at)}</span>
                ${isAdmin ? `<span style="color:#00d4ff;">${msg.is_read ? '✓✓' : '✓'}</span>` : ''}
            </div>`;
        msgsEl.appendChild(wrap);
        scrollDown();
        return dateStr;
    }

    function escapeHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ── Load a session ────────────────────────────────────────────────
    async function loadSession(sid) {
        currentSessionId = sid;

        // Switch panes
        paneEmpty.style.display = 'none';
        paneConv.style.display  = 'flex';

        // Highlight active session in list
        sessionBtns.forEach(b => b.classList.toggle('active', b.dataset.sid === sid));

        // Fetch messages from server
        const res  = await fetch(`/admin/chat/${sid}`, {
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Accept':       'application/json',
            },
        });
        const data = await res.json();

        // Update header
        headerName.textContent   = data.session.name  ?? 'Visitor';
        headerEmail.textContent  = data.session.email ?? '';
        headerAvatar.textContent = (data.session.name ?? 'V').charAt(0).toUpperCase();

        // Render messages
        msgsEl.innerHTML = '';
        let prevDate = null;
        data.messages.forEach(m => { prevDate = appendMsg(m, prevDate); });

        // Remove unread badge from sidebar item
        const btn = document.querySelector(`.session-item[data-sid="${sid}"]`);
        if (btn) btn.querySelector('.session-unread-badge')?.remove();

        // Subscribe to Echo channel
        subscribeEcho(sid);
    }

    // ── Echo subscription ─────────────────────────────────────────────
    function subscribeEcho(sid) {
        if (echoChannel) echoChannel.stopListening('.message.sent');
        if (!window.Echo) return;
        echoChannel = window.Echo.channel(`chat.${sid}`);
        echoChannel.listen('.message.sent', (data) => {
            if (data.session_id !== currentSessionId) return;
            // Append message that came from client (admin's own are rendered optimistically)
            if (data.sender_type === 'client') {
                let prevDate = null;
                const existing = msgsEl.querySelectorAll('.admin-bubble-wrap');
                if (existing.length) {
                    const lastMeta = existing[existing.length - 1].querySelector('.admin-bubble-meta span');
                    // approximate: just pass current date to avoid separator spam
                }
                appendMsg(data, null);
                // Immediately mark it as read since admin is looking at it
                fetch(`/admin/chat/${currentSessionId}`, {
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
                }).catch(() => {});
            }
        });
    }

    // ── Session button clicks ─────────────────────────────────────────
    sessionBtns.forEach(btn => {
        btn.addEventListener('click', () => loadSession(btn.dataset.sid));
    });

    // ── Reply form submit ─────────────────────────────────────────────
    replyForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const text = replyInput.value.trim();
        if (!text || !currentSessionId) return;

        replyInput.value = '';
        replyInput.style.height = 'auto';

        // Optimistic render
        const optimistic = {
            id: Date.now(), sender_type: 'admin',
            message: text, is_read: false,
            created_at: new Date().toISOString(),
        };
        appendMsg(optimistic, null);

        await fetch(`/admin/chat/${currentSessionId}/reply`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
            },
            body: JSON.stringify({ message: text }),
        });
    });

    // Enter key shortcut
    replyInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            replyForm.dispatchEvent(new Event('submit'));
        }
    });

    // Auto-resize textarea
    replyInput.addEventListener('input', () => {
        replyInput.style.height = 'auto';
        replyInput.style.height = Math.min(replyInput.scrollHeight, 96) + 'px';
    });

    // ── Close session ─────────────────────────────────────────────────
    closeBtn.addEventListener('click', async () => {
        if (!currentSessionId || !confirm('Close this chat session?')) return;
        await fetch(`/admin/chat/${currentSessionId}/close`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': CSRF },
        });
        // Update badge in sidebar
        const btn = document.querySelector(`.session-item[data-sid="${currentSessionId}"]`);
        if (btn) {
            const badge = btn.querySelector('.badge-green');
            if (badge) { badge.textContent = 'Closed'; badge.className = 'badge-gray'; badge.style.cssText = 'font-size:.55rem;padding:.1rem .45rem;'; }
        }
        paneEmpty.style.display = '';
        paneConv.style.display  = 'none';
        currentSessionId = null;
    });

    // ── Reverb / Echo bootstrap for admin ────────────────────────────
    // The echo instance is shared from chat.js loaded by Vite.
    // If the admin layout doesn't include chat.js, boot Echo here instead.
    if (!window.Echo) {
        import('laravel-echo').then(({ default: Echo }) => {
            import('pusher-js').then(({ default: Pusher }) => {
                window.Pusher = Pusher;
                window.Echo = new Echo({
                    broadcaster:   'reverb',
                    key:           '{{ env("VITE_REVERB_APP_KEY") }}',
                    wsHost:        '{{ env("VITE_REVERB_HOST", "127.0.0.1") }}',
                    wsPort:        {{ env("VITE_REVERB_PORT", 8080) }},
                    wssPort:       {{ env("VITE_REVERB_PORT", 8080) }},
                    forceTLS:      {{ env("VITE_REVERB_SCHEME", "http") === "https" ? "true" : "false" }},
                    enabledTransports: ['ws', 'wss'],
                });
            });
        });
    }
})();
</script>
@endpush
