<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MemberCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Member data
     * @var \App\Models\Master\Member
     */
    public $member;

    /**
     * Credentials
     * @var array
     */
    public $credentials;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($member, $credentials)
    {
      $this->member = $member;
      $this->credentials = $credentials;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('member-created');
    }
}
