<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use App\Models\Project;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateOrCreateAddress
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $User;
    public $Project;
    public $address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User &$User, Project &$Project, array &$address)
    {
        $this->User = &$User;
        $this->Project = &$Project;
        $this->address = &$address;
    }
}
