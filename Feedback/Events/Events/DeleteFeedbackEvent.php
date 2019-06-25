<?php

namespace App\Containers\Feedback\Events\Events;

use App\Port\Event\Abstracts\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DeleteFeedbackEvent extends Event implements ShouldBroadcastNow
{

    use SerializesModels;

    /**
     * @var
     */
    public $data;

    /**
     * DeleteFeedbackEvent constructor.
     *
     * @param $user_id
     */
    public function __construct($data)
    {
        $this->data = (array)$data;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [json_encode(['service' => 'feedback'])];
    }

    public function broadcastWith()
    {   
        return $this->data;  
    }

    public function broadcastAs()
    {
        return 'delete';
    }
}
