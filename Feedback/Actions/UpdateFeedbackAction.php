<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Services\UpdateFeedbackService;
use App\Containers\Feedback\UI\API\Requests\UpdateFeedbackRequest;
use App\Port\Action\Abstracts\Action;

/**
 * Class UpdateFeedbackAction.
 *
 * @author Vasyl Perun <{{EMAIL}>
 */
class UpdateFeedbackAction extends Action
{

    /**
     * @var  \App\Containers\Feedback\Services\UpdateFeedbackService
     */
    private $updateFeedbackService;

    /**
     * UpdateFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Services\UpdateFeedbackService $updateFeedbackService
     */
    public function __construct(UpdateFeedbackService $updateFeedbackService)
    {
        $this->updateFeedbackService = $updateFeedbackService;
    }

    /**
     * @param  $params
     *
     * @return  mixed
     */
    public function run(UpdateFeedbackRequest $request)
    {
        $feedback = $this->updateFeedbackService->run($request);

        return $feedback;
    }
}
