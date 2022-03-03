<?php

namespace App\Events;

use App\Models\CharacterPosition;
use App\Models\Map;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class PlayerMoved implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    private $mapId;
    public $character_id;
    public $x_axis;
    public $y_axis;

    public function __construct(int $mapId, CharacterPosition $characterPosition)
    {
        $this->mapId = $mapId;
        $this->character_id = $characterPosition->character_id;
        $this->x_axis = $characterPosition->x_axis;
        $this->y_axis = $characterPosition->y_axis;
    }


    public function broadcastAs()
    {
        return 'maps.' . $this->mapId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */

    public function broadcastOn()
    {
        return new Channel('maps.' . $this->mapId);
//        return new Channel('maps');
    }
}
