<?php

namespace Yjtec\Upload\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UploadEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $file;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($file)
    {
        $this->file = $file;

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
