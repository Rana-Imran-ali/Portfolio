<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use App\Models\ChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Handles real-time chat for front-end (guest) users.
 */
class ChatController extends Controller
{
    /**
     * Start or resume a chat session.
     * The browser generates and persists a UUID in localStorage; we use it as session_id.
     */
    public function start(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:64',
            'name'       => 'required|string|max:100',
            'email'      => 'nullable|email|max:255',
        ]);

        $session = ChatSession::firstOrCreate(
            ['session_id' => $request->session_id],
            [
                'name'  => $request->name,
                'email' => $request->email,
            ]
        );

        return response()->json([
            'session' => $session,
            // Load last 50 messages so the client can restore conversation history
            'messages' => $session->messages()->latest()->limit(50)->get()->reverse()->values(),
        ]);
    }

    /**
     * Send a message from the client to the admin.
     */
    public function sendMessage(Request $request, string $sessionId): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $session = ChatSession::where('session_id', $sessionId)->firstOrFail();

        $msg = $session->messages()->create([
            'sender_type' => 'client',
            'message'     => $request->message,
            'is_read'     => false,
        ]);

        // Increment unread count for admin and update last activity timestamp
        $session->increment('unread_by_admin');
        $session->update(['last_message_at' => now()]);

        // Broadcast to both the client widget and the admin panel
        broadcast(new ChatMessageSent($msg->load('session')))->toOthers();

        return response()->json([
            'message' => $msg,
        ]);
    }

    /**
     * Mark all admin messages in this session as read by the client.
     * Called when the client opens/focuses the chat widget.
     */
    public function markRead(Request $request, string $sessionId): JsonResponse
    {
        $session = ChatSession::where('session_id', $sessionId)->firstOrFail();

        $session->messages()
            ->where('sender_type', 'admin')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $session->update(['unread_by_client' => 0]);

        return response()->json(['status' => 'ok']);
    }
}
