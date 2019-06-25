<?php

namespace App\Containers\Feedback\Settings\Providers;

use App\Containers\Feedback\Events\Handlers\FeedbackEventHandler;
use App\Containers\Feedback\Events\Events\FeedbackEvent;
use App\Port\Event\Providers\PortEventsServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

/**
 * Class EventsServiceProvider
 *
 * @author  Mahmoud Zalt  <mahmoud@zalt.me>
 */
class EventsServiceProvider extends PortEventsServiceProvider
{

    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CreateFeedbackEvent::class => [
            CreateFeedbackEventHandler::class,
        ],
        UpdateFeedbackEvent::class => [
            UpdateFeedbackEventHandler::class,
        ],
        DeleteFeedbackEvent::class => [
            DeleteFeedbackEventHandler::class,
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
