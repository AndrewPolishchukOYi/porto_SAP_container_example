<?php

namespace App\Containers\Feedback\Services;

use App\Containers\Feedback\Contracts\CriteriaRepositoryInterface;
use App\Port\Service\Abstracts\Service;
use Exception;

/**
 * Class FeedbackCriteriaService.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackCriteriaService extends Service
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $criteriaRepository;

    /**
     * CreateFeedbackService constructor.
     *
     * @param \App\Containers\Feedback\Contracts\CriteriaRepositoryInterface   $criteriaRepository
     */
    public function __construct(CriteriaRepositoryInterface $criteriaRepository ) 
    {
        $this->criteriaRepository = $criteriaRepository;
    }


    /**
     * @param $data
     *
     * @return  mixed
     */
    public function create($data)
    {
        try {
            // create new Criteria
            $criteria = $this->criteriaRepository->create($data);

        } catch (Exception $e) {
            throw (new Exception($e))->debug($e);
        }

        return $criteria;
    }


    /**
     * @param $data
     *
     * @return  mixed
     */
    public function update($request)
    {
        $attributes = [];
        $request_attributes = $request->rules();
        if(count($request_attributes))
        foreach ($request_attributes as $key => $value) {
            if(isset($request[$key]))$attributes[$key] = $request[$key];
        }

        // check if data is empty
        if (!$attributes) {
            throw new Exception('Inputs are empty.');
        }

        // updating the attributes
        $criteria = $this->criteriaRepository->update($attributes, $request->id);
        // run UpdateLevelEvent on update level item
        // event(new UpdateLevelEvent($level));

        return $criteria;
    }
}
