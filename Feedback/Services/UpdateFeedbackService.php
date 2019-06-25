<?php

namespace App\Containers\Feedback\Services;

use App\Containers\ApiAuthentication\Exceptions\UpdateResourceFailedException;
use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Port\Service\Abstracts\Service;
use App\Containers\Feedback\Events\Events\UpdateFeedbackEvent;
use Illuminate\Support\Facades\Hash;

/**
 * Class UpdateFeedbackService.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class UpdateFeedbackService extends Service
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
     *
     * @param $data
     *
     * @return  mixed
     */
    public function run($request)
    {
 
        $attributes = [];
        $request_attributes = $request->rules();
        if(count($request_attributes))
        foreach ($request_attributes as $key => $value) {
            if(isset($request[$key]))$attributes[$key] = $request[$key];
        }

        // check if data is empty
        if (!$attributes) {
            throw new UpdateResourceFailedException('Inputs are empty.');
        }

        // updating the attributes
        $feedback = $this->feedbackRepository->update($attributes, $request->id);
        // run UpdateFeedbackEvent on update feedback item
        event(new UpdateFeedbackEvent($feedback));

        return $feedback;
    }


}
