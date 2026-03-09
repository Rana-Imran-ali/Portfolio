<?php

namespace App\Http\Controllers\Admin;

use App\Events\ChatMessageSent;
use App\Http\Controllers\Controller;
use App\Models\ChatSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Handles real-time chat for the admin panel.
 */
class ChatController extends Controller
{
    /**
     * Show all active chat sessions (admin view).
     */
    public function index()
    {
        $sessions = ChatSession::with('latestMessage')
            ->orderByDesc('last_message_at')
            ->paginate(20);

        return view('admin.chat.index', compact('sessions'));
    }

    /**
     * Show a single chat session and its full message history.
     */
    public function show(string $sessionId): JsonResponse
    {
        $session = ChatSession::where('session_id', $sessionId)->firstOrFail();

        // Mark all client messages as read when admin opens the conversation
        $session->messages()
            ->where('sender_type', 'client')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $session->update(['unread_by_admin' => 0]);

        return response()->json([
            'session'  => $session,
            'messages' => $session->messages()->oldest()->get(),
        ]);
    }

    /**
     * Send a reply from the admin to the client.
     */
    public function reply(Request $request, string $sessionId): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $session = ChatSession::where('session_id', $sessionId)->firstOrFail();

        $msg = $session->messages()->create([
            'sender_type' => 'admin',
            'message'     => $request->message,
            'is_read'     => false,
        ]);

        // Notify client that they have a new unread message
        $session->increment('unread_by_client');
        $session->update(['last_message_at' => now()]);

        // Broadcast to the client's channel and the admin's own panel
        broadcast(new ChatMessageSent($msg->load('session')));

        return response()->json(['message' => $msg]);
    }

    /**
     * Close a chat session (soft-status update).
     */
    public function close(string $sessionId): JsonResponse
    {
        ChatSession::where('session_id', $sessionId)
            ->update(['status' => 'closed']);

        return response()->json(['status' => 'closed']);
    }
}
