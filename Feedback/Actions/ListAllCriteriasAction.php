<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Contracts\CriteriaRepositoryInterface;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListAllFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class ListAllCriteriasAction extends Action
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $criteriaRepository;

    /**
     * ListAllFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(CriteriaRepositoryInterface $criteriaRepository)
    {
        $this->criteriaRepository = $criteriaRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $criterias = $this->criteriaRepository;

        return $criterias;
    }
}
