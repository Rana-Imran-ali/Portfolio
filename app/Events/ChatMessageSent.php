<?php

namespace App\Events;

use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Fired whenever a new chat message is stored.
 * Broadcasts instantly (ShouldBroadcastNow) on a public channel
 * so both the client widget and the admin panel receive it in real-time.
 */
class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(public ChatMessage $chatMessage)
    {
    }

    /**
     * Channel name: "chat.{session_id}" where session_id is the UUID string.
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('chat.' . $this->chatMessage->session->session_id),
        ];
    }

    /**
     * Only broadcast the fields the frontend needs.
     */
    public function broadcastWith(): array
    {
        return [
            'id'          => $this->chatMessage->id,
            'session_id'  => $this->chatMessage->session->session_id,
            'sender_type' => $this->chatMessage->sender_type,
            'message'     => $this->chatMessage->message,
            'is_read'     => $this->chatMessage->is_read,
            'created_at'  => $this->chatMessage->created_at->toISOString(),
        ];
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }
}
