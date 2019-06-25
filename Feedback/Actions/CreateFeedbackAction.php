<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Events\Events\CreateFeedbackEvent;
use App\Containers\Feedback\Services\CreateFeedbackService;
use App\Containers\Feedback\UI\API\Requests\CreateFeedbackRequest;
use App\Containers\Feedback\UI\API\Requests\CreateFeedbacksRequest;
use App\Port\Action\Abstracts\Action;
use App\Port\Event\Dispatcher\EventsDispatcher;

/**
 * Class CreateFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CreateFeedbackAction extends Action
{

    /**
     * @var  \App\Containers\Feedback\Services\CreateFeedbackService
     */
    private $createFeedbackService;

    /**
     * CreateFeedbackAction constructor.
     *
     * @param CreateFeedbackService $createFeedbackService
     */
    public function __construct(CreateFeedbackService $createFeedbackService)
    {
        $this->createFeedbackService = $createFeedbackService;
    }

    /**
     * create a new Feedback object.
     *
     * @param      $request
     *
     * @return mixed
     */
    public function run(CreateFeedbackRequest $request)
    {
        $params = [];
        $request_attributes = $request->rules();
        if(count($request_attributes)){
            foreach ($request_attributes as $key => $value) {
                if(isset($request[$key]))$params[$key] = $request[$key];
            }
            $params['user_id'] = \Auth::user()->id;
        }
        $feedback = $this->createFeedbackService->create($params);

        return $feedback;
    }

    public function runMany(CreateFeedbacksRequest $request)
    {
        $params = [];
        $request_attributes = $request->rules();
        if(count($request_attributes)){
            foreach ($request_attributes as $key => $value) {
                if(isset($request[$key]))$params[$key] = $request[$key];
            }
            $params['user_id'] = \Auth::user()->id;
        }
        $feedbacks = $this->createFeedbackService->createMany($params);

        return $feedbacks;
    }


}
