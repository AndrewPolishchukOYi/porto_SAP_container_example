<?php

namespace App\Containers\Feedback\Events\Handlers;

use App\Containers\Feedback\Events\Events\FeedbackEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteFeedbackEventHandler 
{

    /**
     * @param \App\Containers\UserDetails\Events\Events\UserDetailsEvent $event
     * @throws ActivitiesFailedException
     */
    public function handle(FeedbackEvent $event)
    {
        // do  something on delete Feedback event handle
    }
}
