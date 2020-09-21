<?php

namespace App\Events\Users;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailMutated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public string $old_email;
    public string $new_email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, string $old_email, string $new_email)
    {
        $this->user = $user;
        $this->old_email = $old_email;
        $this->new_email = $new_email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
