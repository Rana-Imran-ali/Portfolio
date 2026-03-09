/**
 * chat.js — Real-time Chat Widget for Frontend Visitors
 *
 * Flow:
 *  1. Page load → check localStorage for existing session_id
 *  2. User clicks toggle → show widget
 *  3. If no session → show intro form (name/email)
 *  4. On intro submit → POST /chat/start → start session
 *  5. Subscribe to Echo channel "chat.{session_id}" for real-time updates
 *  6. User sends a message → POST /chat/{sessionId}/send
 *  7. Admin replies arrive via Echo → appended to message list
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// ── Bootstrap Echo (Reverb uses Pusher-compatible protocol) ──────────
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster:  'reverb',
    key:          import.meta.env.VITE_REVERB_APP_KEY,
    wsHost:       import.meta.env.VITE_REVERB_HOST,
    wsPort:       import.meta.env.VITE_REVERB_PORT ?? 8080,
    wssPort:      import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS:     (import.meta.env.VITE_REVERB_SCHEME ?? 'http') === 'https',
    enabledTransports: ['ws', 'wss'],
});

// ── State ────────────────────────────────────────────────────────────
let sessionId   = localStorage.getItem('chat_session_id') || null;
let echoChannel = null;
let unreadCount = 0;

// ── DOM refs ──────────────────────────────────────────────────────────
const toggle     = document.getElementById('chat-toggle');
const chatBox    = document.getElementById('chat-box');
const iconOpen   = document.getElementById('chat-icon-open');
const iconClose  = document.getElementById('chat-icon-close');
const badge      = document.getElementById('chat-badge');
const closeBtn   = document.getElementById('chat-close-btn');
const introDiv   = document.getElementById('chat-intro');
const convDiv    = document.getElementById('chat-conversation');
const introForm  = document.getElementById('chat-intro-form');
const msgForm    = document.getElementById('chat-message-form');
const msgInput   = document.getElementById('chat-msg-input');
const msgsEl     = document.getElementById('chat-messages');
const sendBtn    = document.getElementById('chat-send-btn');
const introError = document.getElementById('chat-intro-error');
const typingEl   = document.getElementById('chat-typing');

// ── Helpers ───────────────────────────────────────────────────────────
function generateUUID() {
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, c => {
        const r = Math.random() * 16 | 0;
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
}

function formatTime(isoString) {
    const d = new Date(isoString);
    return d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

function formatDate(isoString) {
    const d = new Date(isoString);
    const today = new Date();
    const yesterday = new Date(today); yesterday.setDate(today.getDate() - 1);
    if (d.toDateString() === today.toDateString())     return 'Today';
    if (d.toDateString() === yesterday.toDateString()) return 'Yesterday';
    return d.toLocaleDateString([], { month: 'short', day: 'numeric' });
}

function scrollToBottom() {
    msgsEl.scrollTop = msgsEl.scrollHeight;
}

function updateBadge() {
    if (unreadCount > 0) {
        badge.textContent = unreadCount > 9 ? '9+' : unreadCount;
        badge.classList.remove('hidden');
    } else {
        badge.classList.add('hidden');
    }
}

/** Render a single bubble into the messages container */
function appendMessage(msg, skipSeparator = false) {
    // Date separator
    if (!skipSeparator) {
        const lastSep = msgsEl.querySelector('.chat-date-sep:last-of-type');
        const dateStr = formatDate(msg.created_at);
        if (!lastSep || lastSep.textContent !== dateStr) {
            const sep = document.createElement('div');
            sep.className = 'chat-date-sep';
            sep.textContent = dateStr;
            msgsEl.appendChild(sep);
        }
    }

    const isClient = msg.sender_type === 'client';
    const wrap = document.createElement('div');
    wrap.className = `chat-bubble-wrap ${isClient ? 'client' : 'admin'}`;
    wrap.dataset.msgId = msg.id;

    const bubble = document.createElement('div');
    bubble.className = `chat-bubble ${isClient ? 'client' : 'admin'}`;
    bubble.textContent = msg.message;

    const meta = document.createElement('div');
    meta.className = 'chat-bubble-meta';
    meta.innerHTML = `<span>${formatTime(msg.created_at)}</span>`
        + (isClient ? `<span class="chat-read-tick">${msg.is_read ? '✓✓' : '✓'}</span>` : '');

    wrap.appendChild(bubble);
    wrap.appendChild(meta);
    msgsEl.appendChild(wrap);
    scrollToBottom();
}

/** Render a full history of messages */
function renderHistory(messages) {
    msgsEl.innerHTML = '';
    if (!messages.length) {
        msgsEl.innerHTML = '<div style="text-align:center;color:#475569;font-size:.78rem;margin:1rem 0;">Send a message to start the conversation!</div>';
        return;
    }
    messages.forEach((msg, i) => appendMessage(msg, i > 0 && formatDate(msg.created_at) === formatDate(messages[i-1].created_at)));
}

// ── Echo subscription ─────────────────────────────────────────────────
function subscribeChannel(sid) {
    if (echoChannel) echoChannel.stopListening('.message.sent');
    echoChannel = window.Echo.channel(`chat.${sid}`);
    echoChannel.listen('.message.sent', (data) => {
        // Only render if comes from admin (client's own messages are rendered optimistically)
        if (data.sender_type === 'admin') {
            appendMessage(data);
            // If chat is hidden, increment badge
            if (chatBox.classList.contains('hidden')) {
                unreadCount++;
                updateBadge();
            } else {
                // Mark read immediately
                markRead(sid);
            }
        }
    });
}

// ── API calls ─────────────────────────────────────────────────────────
async function startSession(name, email) {
    const sid = generateUUID();
    const res = await fetch('/chat/start', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ session_id: sid, name, email }),
    });
    if (!res.ok) throw new Error('Failed to start chat session');
    return res.json();
}

async function resumeSession(sid) {
    const res = await fetch('/chat/start', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ session_id: sid, name: 'Returning User' }),
    });
    if (!res.ok) throw new Error('Failed to resume session');
    return res.json();
}

async function sendMessage(sid, text) {
    const res = await fetch(`/chat/${sid}/send`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').content,
        },
        body: JSON.stringify({ message: text }),
    });
    if (!res.ok) throw new Error('Failed to send message');
    return res.json();
}

async function markRead(sid) {
    fetch(`/chat/${sid}/read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN':  document.querySelector('meta[name="csrf-token"]').content,
        },
    }).catch(() => {});
}

// ── Widget open/close ─────────────────────────────────────────────────
function openWidget() {
    chatBox.classList.remove('hidden');
    iconOpen.classList.add('hidden');
    iconClose.classList.remove('hidden');
    toggle.setAttribute('aria-expanded', 'true');

    // Reset badge when opened
    if (unreadCount > 0) {
        unreadCount = 0;
        updateBadge();
    }

    // If session exists, mark messages as read
    if (sessionId) markRead(sessionId);

    // If session exists, skip intro
    if (sessionId) {
        showConversation();
    }
}

function closeWidget() {
    chatBox.classList.add('hidden');
    iconOpen.classList.remove('hidden');
    iconClose.classList.add('hidden');
    toggle.setAttribute('aria-expanded', 'false');
}

function showConversation() {
    introDiv.classList.add('hidden');
    convDiv.classList.remove('hidden');
}

// ── Event listeners ───────────────────────────────────────────────────
toggle.addEventListener('click', () => {
    chatBox.classList.contains('hidden') ? openWidget() : closeWidget();
});

closeBtn.addEventListener('click', closeWidget);

// Intro form submit – start a new session
introForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const name  = document.getElementById('chat-name-input').value.trim();
    const email = document.getElementById('chat-email-input').value.trim();
    introError.classList.add('hidden');

    if (!name) {
        introError.textContent = 'Please enter your name.';
        introError.classList.remove('hidden');
        return;
    }

    const submitBtn = introForm.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Starting…';

    try {
        const data = await startSession(name, email);
        sessionId = data.session.session_id;
        localStorage.setItem('chat_session_id', sessionId);
        renderHistory(data.messages);
        subscribeChannel(sessionId);
        showConversation();
    } catch (err) {
        introError.textContent = 'Could not connect. Please try again.';
        introError.classList.remove('hidden');
    } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Start Chatting <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width:1rem;height:1rem;display:inline-block;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>';
    }
});

// Auto-resize textarea
msgInput.addEventListener('input', () => {
    msgInput.style.height = 'auto';
    msgInput.style.height = Math.min(msgInput.scrollHeight, 96) + 'px';
});

// Send on Ctrl+Enter or Enter (not shift)
msgInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        msgForm.dispatchEvent(new Event('submit'));
    }
});

// Message form submit
msgForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const text = msgInput.value.trim();
    if (!text || !sessionId) return;

    sendBtn.disabled = true;
    const optimistic = {
        id: Date.now(),
        sender_type: 'client',
        message: text,
        is_read: false,
        created_at: new Date().toISOString(),
    };
    appendMessage(optimistic);
    msgInput.value = '';
    msgInput.style.height = 'auto';

    try {
        await sendMessage(sessionId, text);
    } catch {
        // In case of failure, show a small error in the chat
        const errDiv = document.createElement('div');
        errDiv.style.cssText = 'text-align:center;color:#f87171;font-size:.72rem;margin:.25rem 0;';
        errDiv.textContent = '⚠ Failed to send. Please retry.';
        msgsEl.appendChild(errDiv);
        scrollToBottom();
    } finally {
        sendBtn.disabled = false;
    }
});

// ── On page load: resume session if stored ────────────────────────────
if (sessionId) {
    resumeSession(sessionId).then(data => {
        renderHistory(data.messages);
        subscribeChannel(sessionId);
        // Count unread admin messages when widget is closed
        const unread = data.messages.filter(m => m.sender_type === 'admin' && !m.is_read).length;
        if (unread > 0) {
            unreadCount = unread;
            updateBadge();
        }
    }).catch(() => {
        // Session may have expired; clear it and let user start fresh
        localStorage.removeItem('chat_session_id');
        sessionId = null;
    });
}
