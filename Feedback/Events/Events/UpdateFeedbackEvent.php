<?php

namespace App\Containers\Feedback\Events\Events;

use App\Port\Event\Abstracts\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Containers\Feedback\UI\API\Transformers\FeedbackTransformer;

class UpdateFeedbackEvent extends Event implements ShouldBroadcastNow
{

    use SerializesModels;

    /**
     * @var
     */
    public $data;

    /**
     * UpdateFeedbackEvent constructor.
     *
     * @param $user_id
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        return (new FeedbackTransformer())->transform($this->data);
    }

    public function broadcastAs()
    {
        return 'update';
    }
}
