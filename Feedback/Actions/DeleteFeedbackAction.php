<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Port\Action\Abstracts\Action;
use App\Containers\Feedback\Events\Events\DeleteFeedbackEvent;

/**
 * Class DeleteFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class DeleteFeedbackAction extends Action
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $feedbackRepository;

    /**
     * UpdateFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @param $feedbackId
     *
     * @return bool
     */
    public function run($feedbackId)
    {
        // delete the record from the table.
        $this->feedbackRepository->delete($feedbackId);
        // run DeleteFeedbackEvent on delete feedback item
        event(new DeleteFeedbackEvent(['id' => $feedbackId]));

        return true;
    }
}
