<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Exceptions\FeedbackNotFoundException;
use App\Containers\Feedback\Services\FindFeedbackService;
use App\Port\Action\Abstracts\Action;
use Exception;

/**
 * Class FindFeedbackAction.
 *
 * @author Vasyl Perun <Feedbackname@kindgeek.com>
 */
class FindFeedbackAction extends Action
{

    /**
     * @var  \App\Containers\Feedback\Services\FindFeedbackService
     */
    private $findFeedbackService;

    /**
     * FindFeedbackByIdAction constructor.
     *
     * @param \App\Containers\Feedback\Services\FindFeedbackService $findFeedbackService
     */
    public function __construct(
        FindFeedbackService $findFeedbackService
    ) {
        $this->findFeedbackService = $findFeedbackService;
    }


    /**
     * @param $id
     *
     * @return  mixed
     */
    public function run($id)
    {
        try {
            $feedback = $this->findFeedbackService->byId($id);
        } catch (Exception $e) {
            throw new FeedbackNotFoundException;
        }

        return $feedback;
    }
}
