<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListAllFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class ListAllFeedbackAction extends Action
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $feedbackRepository;

    /**
     * ListAllFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $feedbacks = $this->feedbackRepository;

        return $feedbacks;
    }
}
