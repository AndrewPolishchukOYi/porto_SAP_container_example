<?php

namespace App\Containers\Feedback\Services;

use App\Containers\CourseClass\Models\Lesson;
use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Containers\Feedback\Exceptions\FeedbackFailedException;
use App\Containers\Comment\Models\Comment;
use App\Containers\Feedback\Models\Feedback;
use App\Containers\Feedback\Models\Grade;
use App\Port\Service\Abstracts\Service;
use App\Containers\Feedback\Events\Events\CreateFeedbackEvent;
use Exception;
use Illuminate\Support\Collection;

use \Carbon\Carbon;

/**
 * Class CreateFeedbackService.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CreateFeedbackService extends Service
{

    /**
     * @var \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface
     */
    private $feedbackRepository;

    /**
     * CreateFeedbackService constructor.
     *
     * @param \App\Containers\Feedback\Contracts\FeedbackRepositoryInterface   $feedbackRepository
     */
    public function __construct(
        FeedbackRepositoryInterface $feedbackRepository
    ) {
        $this->feedbackRepository = $feedbackRepository;
    }


    /**
     * @param $data
     *
     * @return  mixed
     */
    public function create($data)
    {

        try {
            // create new Feedback

            $feedback = $this->feedbackRepository->create($data);

            if($feedback->id){


                $feedback_data = [];

                if(isset($data['recommendation'])){
                    $new_recommendation = new Comment();
                    $new_recommendation->user_id = $data['user_id'];
                    $new_recommendation->parent_type = 'feedback';
                    $new_recommendation->parent_id = $feedback->id;
                    $new_recommendation->content = $data['recommendation'];
                    $new_recommendation->save();
                }

                if(isset($data['comment'])){
                    $new_comment = new Comment();
                    $new_comment->user_id = $data['user_id'];
                    $new_comment->parent_type = 'feedback';
                    $new_comment->parent_id = $feedback->id;
                    $new_comment->content = $data['comment'];
                    $new_comment->save();
                }

                if(isset($new_comment->id)){
                    $feedback_data['comment_id'] = $new_comment->id;
                }

                if(isset($new_recommendation->id)){
                    $feedback_data['recommendation_id'] = $new_recommendation->id;
                }

                $feedback = $this->feedbackRepository->update($feedback_data, $feedback->id);

                foreach ($data['ranges'] as $range) {
                    $new_range = new Grade();
                    $new_range->points = $range['points'];
                    $new_range->criteria_id = $range['id'];
                    $new_range->feedback_id = $feedback->id;
                    $new_range->save();
                }

                if(\Auth::user()->roles()->first()->name === 'student'){
                    $teacher_feedback = Feedback::where('user_id', $data['recipient_id'])
                        ->where('lesson_id', $data['lesson_id'])
                        ->where('recipient_id', \Auth::user()->id)
                        ->first();

                    $teacher_feedback->update([
                        'status' => Feedback::STATUS_VIEWED
                    ]);
                }
            }

            // run CreateFeedbackEvent on create feedback item
            event(new CreateFeedbackEvent($feedback, [$feedback->recipient_id]));
        } catch (Exception $e) {
            throw (new FeedbackFailedException($e))->debug($e);
        }

        return $feedback;
    }


    /**
     * @param $data
     *
     * @return  mixed
     */
    public function createMany($data)
    {

        $collection = new Collection();

        foreach ($data['feedbacks'] as $feedback){
            $feedback['user_id'] = $data['user_id'];
            $item = $this->create($feedback);
            $collection->push($item);
            $lesson_id = $feedback['lesson_id'];
        }

        $lesson = Lesson::find($lesson_id);

        $last_feedback = $lesson->feedbacks()
            ->where('user_id', \Auth::user()->id)
            ->orderBy('created_at','desc')
            ->first();

        $minutes = $lesson->program->duration + $lesson->course_class->students->count()*$lesson->program->feedback_time;

        if($last_feedback->created_at > Carbon::parse($lesson->due_date)->addMinutes($minutes/60))$lesson->update(['penalty' => 1]);


        return $collection;
    }
}
