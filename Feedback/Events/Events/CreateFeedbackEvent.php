<?php

namespace App\Containers\Feedback\Events\Events;

use App\Port\Event\Abstracts\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use App\Containers\Feedback\UI\API\Transformers\FeedbackTransformer;

use App\Port\Helpers\Traits\TransformerTrait;

class CreateFeedbackEvent extends Event implements ShouldBroadcastNow
{

    use SerializesModels;
    use TransformerTrait;

    /**
     * @var
     */
    public $data, $participants;

    /**
     * CreateFeedbackEvent constructor.
     *
     * @param $user_id
     */
    public function __construct($data, $participants=[])
    {
        $this->data = $data;
        $this->participants = $participants;
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
        return array_merge($this->getItem($this->data,new FeedbackTransformer(), ['lesson.feedbacks','lesson.course_class','recommendation','donor']),['participants'=>$this->participants]);
    }

    public function broadcastAs()
    {
        return 'create';
    }
}
