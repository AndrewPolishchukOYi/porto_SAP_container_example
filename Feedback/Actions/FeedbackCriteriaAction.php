<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Contracts\CriteriaRepositoryInterface;
use App\Port\Action\Abstracts\Action;
use App\Containers\Feedback\Services\FeedbackCriteriaService;

/**
 * Class ListAllFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackCriteriaAction extends Action
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $criteriaRepository;

    /**
     * @var \App\Containers\Feedback\Services\FeedbackCriteriaService
     */
    private $feedbackCriteriaService;

    /**
     * ListAllFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(CriteriaRepositoryInterface $criteriaRepository, FeedbackCriteriaService $feedbackCriteriaService)
    {
        $this->criteriaRepository = $criteriaRepository;
        $this->criteriaService = $feedbackCriteriaService;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        $criterias = $this->criteriaRepository;

        return $criterias;
    }

    /**
     * @return mixed
     */
    public function findById($id)
    {
        $criterias = $this->criteriaRepository->find($id);

        return $criterias;
    }

    /**
     * @return mixed
     */
    public function create($request)
    {
        $params = [];
        $request_attributes = $request->rules();
        if(count($request_attributes)){
            foreach ($request_attributes as $key => $value) {
                if(isset($request[$key]))$params[$key] = $request[$key];
            }
            $params['user_id'] = \Auth::user()->id;
        }
        $criteria = $this->criteriaService->create($params);

        return $criteria;
    }

    /**
     * @return mixed
     */
    public function update($request)
    {
        
        $criteria = $this->criteriaService->update($request);

        return $criteria;
    }

    /**
     * @return mixed
     */
    public function delete($id)
    {
        $criterias = $this->criteriaRepository->delete($id);

        return $criterias;
    }
}
