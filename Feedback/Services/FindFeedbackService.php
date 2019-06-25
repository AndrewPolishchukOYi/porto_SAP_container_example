<?php

namespace App\Containers\Feedback\Services;

use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Port\Service\Abstracts\Service;

/**
 * Class FindFeedbackService.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FindFeedbackService extends Service
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $feedbackRepository;

    /**
     * FindFeedbackService constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * @param $id
     *
     * @return  mixed
     */
    public function byId($id)
    {
        // find the Feedback by its id
        $feedback = $this->feedbackRepository->find($id);

        return $feedback;
    }
}
