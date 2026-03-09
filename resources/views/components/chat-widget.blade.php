{{-- ═══════════════════════════════════════════════ FLOATING CHAT WIDGET ══ --}}
{{-- Included in the frontend layout footer area --}}
<div id="chat-widget" aria-label="Live Chat">

    {{-- ── Toggle Bubble ── --}}
    <button id="chat-toggle"
            aria-label="Open Live Chat"
            aria-expanded="false"
            aria-controls="chat-box"
            title="Chat with us">
        {{-- Chat icon (shown when closed) --}}
        <svg id="chat-icon-open" class="chat-toggle-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        {{-- X icon (shown when open) --}}
        <svg id="chat-icon-close" class="chat-toggle-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        {{-- Notification badge for unread admin replies --}}
        <span id="chat-badge" class="chat-badge hidden" aria-label="Unread messages">0</span>
    </button>

    {{-- ── Chat Box ── --}}
    <div id="chat-box" class="chat-box hidden" role="dialog" aria-modal="true" aria-label="Live Chat Window">

        {{-- Header --}}
        <div class="chat-header">
            <div class="chat-header-info">
                <div class="chat-avatar">
                    <span>ID</span>
                    <span class="chat-online-dot" title="Online"></span>
                </div>
                <div>
                    <p class="chat-header-name">Support Chat</p>
                    <p class="chat-header-status" id="chat-status-txt">● Online</p>
                </div>
            </div>
            <button class="chat-close-btn" id="chat-close-btn" aria-label="Close chat">&times;</button>
        </div>

        {{-- Step 1 – Intro form (name / email) shown before chat starts --}}
        <div id="chat-intro" class="chat-intro">
            <div class="chat-intro-img">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:2.5rem;height:2.5rem;color:#00d4ff;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
            </div>
            <h3 style="font-weight:700;font-size:.95rem;color:#e2e8f0;margin-bottom:.25rem;">Hi there! 👋</h3>
            <p style="font-size:.8rem;color:#94a3b8;margin-bottom:1rem;">
                How can I help you today? Leave a message and I'll get back to you ASAP.
            </p>
            <form id="chat-intro-form" novalidate>
                <input id="chat-name-input"
                       type="text"
                       placeholder="Your name *"
                       class="chat-input-field"
                       required
                       maxlength="100"
                       aria-label="Your name">
                <input id="chat-email-input"
                       type="email"
                       placeholder="Your email (optional)"
                       class="chat-input-field"
                       maxlength="255"
                       aria-label="Your email">
                <p id="chat-intro-error" class="chat-error hidden"></p>
                <button type="submit" class="chat-send-btn" style="width:100%;justify-content:center;">
                    Start Chatting
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1rem;height:1rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>
        </div>

        {{-- Step 2 – The actual chat conversation (hidden until session started) --}}
        <div id="chat-conversation" class="chat-conversation hidden">
            {{-- Messages container --}}
            <div id="chat-messages" class="chat-messages" role="log" aria-live="polite" aria-label="Chat messages">
                {{-- Messages injected by JS --}}
            </div>

            {{-- Typing indicator --}}
            <div id="chat-typing" class="chat-typing-indicator hidden">
                <span></span><span></span><span></span>
                <small>Admin is typing…</small>
            </div>

            {{-- Footer input --}}
            <form id="chat-message-form" class="chat-footer" novalidate>
                <textarea id="chat-msg-input"
                          rows="1"
                          maxlength="2000"
                          placeholder="Type a message…"
                          class="chat-textarea"
                          required
                          aria-label="Message input"></textarea>
                <button type="submit" class="chat-send-btn" id="chat-send-btn" aria-label="Send message">
                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1.1rem;height:1.1rem;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
/* ─── Chat Widget Styles ─────────────────────────────────────────── */
#chat-widget {
    position: fixed;
    bottom: 1.5rem;
    right: 1.5rem;
    z-index: 9999;
    font-family: 'Inter', sans-serif;
}

/* Toggle bubble */
#chat-toggle {
    position: relative;
    width: 3.5rem;
    height: 3.5rem;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #00d4ff, #7c3aed);
    box-shadow: 0 4px 20px rgba(0,212,255,.4);
    transition: transform .2s, box-shadow .2s;
}
#chat-toggle:hover { transform: scale(1.08); box-shadow: 0 6px 28px rgba(0,212,255,.55); }
.chat-toggle-icon { width: 1.5rem; height: 1.5rem; color: #fff; }

/* Notification badge */
.chat-badge {
    position: absolute;
    top: -4px; right: -4px;
    min-width: 1.2rem; height: 1.2rem;
    padding: 0 .3rem;
    background: #ef4444;
    border-radius: 9999px;
    font-size: .65rem;
    font-weight: 700;
    color: #fff;
    display: flex; align-items: center; justify-content: center;
    border: 2px solid #0a0f1e;
    animation: badgePop .2s ease;
}
@keyframes badgePop { from { transform: scale(0); } to { transform: scale(1); } }

/* Chat box */
.chat-box {
    position: absolute;
    bottom: calc(100% + .75rem);
    right: 0;
    width: 340px;
    border-radius: 1rem;
    overflow: hidden;
    background: #0f172a;
    border: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 20px 60px rgba(0,0,0,.6);
    display: flex; flex-direction: column;
    animation: chatSlideUp .25s ease;
    max-height: 540px;
}
@keyframes chatSlideUp {
    from { opacity: 0; transform: translateY(12px) scale(.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* Header */
.chat-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: .85rem 1rem;
    background: linear-gradient(135deg, rgba(0,212,255,.12), rgba(124,58,237,.12));
    border-bottom: 1px solid rgba(255,255,255,.06);
}
.chat-header-info { display: flex; align-items: center; gap: .6rem; }
.chat-avatar {
    position: relative;
    width: 2.2rem; height: 2.2rem;
    border-radius: 50%;
    background: linear-gradient(135deg,#00d4ff,#7c3aed);
    display: flex; align-items: center; justify-content: center;
    font-weight: 800; font-size: .7rem; color: #fff;
}
.chat-online-dot {
    position: absolute; bottom: 0; right: 0;
    width: .6rem; height: .6rem;
    background: #22c55e; border-radius: 50%;
    border: 2px solid #0f172a;
}
.chat-header-name { font-size: .85rem; font-weight: 700; color: #e2e8f0; line-height: 1; }
.chat-header-status { font-size: .7rem; color: #22c55e; margin-top: .15rem; }
.chat-close-btn {
    background: none; border: none; cursor: pointer;
    color: #64748b; font-size: 1.4rem; line-height: 1;
    transition: color .15s;
}
.chat-close-btn:hover { color: #e2e8f0; }

/* Intro form */
.chat-intro {
    padding: 1.25rem 1rem;
    text-align: center;
}
.chat-intro-img {
    display: inline-flex; align-items: center; justify-content: center;
    width: 4rem; height: 4rem; border-radius: 50%;
    background: rgba(0,212,255,.08);
    margin-bottom: .75rem;
}
.chat-input-field {
    width: 100%; padding: .55rem .75rem;
    margin-bottom: .55rem;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: .5rem;
    color: #e2e8f0;
    font-size: .82rem;
    outline: none;
    transition: border-color .15s;
    box-sizing: border-box;
}
.chat-input-field:focus { border-color: rgba(0,212,255,.4); }
.chat-input-field::placeholder { color: #475569; }
.chat-error { color: #f87171; font-size: .75rem; margin-bottom: .5rem; }

/* Conversation area */
.chat-conversation { display: flex; flex-direction: column; flex: 1; min-height: 0; }
.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: .85rem 1rem;
    display: flex; flex-direction: column; gap: .4rem;
    max-height: 320px;
    scroll-behavior: smooth;
}
.chat-messages::-webkit-scrollbar { width: 4px; }
.chat-messages::-webkit-scrollbar-track { background: transparent; }
.chat-messages::-webkit-scrollbar-thumb { background: rgba(255,255,255,.1); border-radius: 2px; }

/* Bubbles */
.chat-bubble-wrap { display: flex; flex-direction: column; max-width: 80%; }
.chat-bubble-wrap.client { align-self: flex-end; align-items: flex-end; }
.chat-bubble-wrap.admin  { align-self: flex-start; align-items: flex-start; }

.chat-bubble {
    padding: .5rem .8rem;
    border-radius: 1rem;
    font-size: .82rem;
    line-height: 1.45;
    word-break: break-word;
}
.chat-bubble.client {
    background: linear-gradient(135deg, #00d4ff22, #7c3aed33);
    border: 1px solid rgba(0,212,255,.2);
    color: #e2e8f0;
    border-bottom-right-radius: .2rem;
}
.chat-bubble.admin {
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.08);
    color: #cbd5e1;
    border-bottom-left-radius: .2rem;
}
.chat-bubble-meta {
    font-size: .65rem; color: #475569; margin-top: .15rem;
    display: flex; align-items: center; gap: .3rem;
}
.chat-read-tick { color: #00d4ff; }

/* Date separator */
.chat-date-sep {
    text-align: center;
    font-size: .65rem;
    color: #334155;
    margin: .4rem 0;
    position: relative;
}
.chat-date-sep::before, .chat-date-sep::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 35%;
    height: 1px;
    background: rgba(255,255,255,.05);
}
.chat-date-sep::before { left: 0; }
.chat-date-sep::after  { right: 0; }

/* Typing indicator */
.chat-typing-indicator {
    display: flex; align-items: center; gap: .3rem;
    padding: .4rem 1rem;
    font-size: .7rem; color: #64748b;
}
.chat-typing-indicator span {
    width: 5px; height: 5px;
    background: #64748b; border-radius: 50%;
    animation: typingDot 1.2s infinite;
}
.chat-typing-indicator span:nth-child(2) { animation-delay: .2s; }
.chat-typing-indicator span:nth-child(3) { animation-delay: .4s; }
@keyframes typingDot {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-5px); }
}

/* Footer input */
.chat-footer {
    display: flex; align-items: flex-end; gap: .5rem;
    padding: .65rem .75rem;
    border-top: 1px solid rgba(255,255,255,.06);
}
.chat-textarea {
    flex: 1;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: .5rem;
    color: #e2e8f0;
    font-size: .82rem;
    padding: .5rem .65rem;
    resize: none;
    outline: none;
    max-height: 96px;
    overflow-y: auto;
    transition: border-color .15s;
    font-family: inherit;
}
.chat-textarea:focus { border-color: rgba(0,212,255,.4); }
.chat-textarea::placeholder { color: #475569; }

.chat-send-btn {
    display: flex; align-items: center; gap: .35rem;
    padding: .5rem .9rem;
    border-radius: .5rem;
    border: none;
    cursor: pointer;
    font-size: .82rem; font-weight: 600;
    background: linear-gradient(135deg, #00d4ff, #7c3aed);
    color: #fff;
    transition: opacity .15s, transform .1s;
    white-space: nowrap;
}
.chat-send-btn:hover { opacity: .88; }
.chat-send-btn:active { transform: scale(.96); }
.chat-send-btn:disabled { opacity: .4; cursor: not-allowed; }

/* Responsive */
@media (max-width: 400px) {
    .chat-box { width: calc(100vw - 2rem); right: -1rem; }
    #chat-widget { right: 1rem; }
}
</style>
