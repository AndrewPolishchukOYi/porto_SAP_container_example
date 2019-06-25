<?php

namespace App\Containers\Feedback\UI\API\Transformers;

use App\Containers\Feedback\Models\Feedback;
use App\Port\Transformer\Abstracts\Transformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Containers\Feedback\UI\API\Transformers\GradeTransformer;
use App\Containers\CourseClass\UI\API\Transformers\LessonTransformer;
use App\Containers\Comment\UI\API\Transformers\CommentTransformer;

use App\Port\Transformer\Eloquent\QueryTransformer;

/**
 * Class FeedbackTransformer.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackTransformer extends Transformer
{
    protected $availableIncludes = [
        'owner',
        'grades',
        'recipient',
        'donor',
        'lesson',
        'comment',
        'recommendation',
    ];

    protected $defaultIncludes = [
        'grades',
        'comment',
        'recipient',
        'recommendation',
    ];

    /**
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return array
     */
    public function transform(Feedback $feedback)
    {


        if(isset($feedback->lesson)){
            $feedback_lesson_point = $feedback->lesson->program->points;

            $total_grades_points = $feedback->grades->sum(function ($item){
                return $item->points;
            });

            $total_criteria_points = $feedback->grades->sum(function ($item){
                return $item->criteria->points;
            });

            $total = ($total_grades_points/$total_criteria_points)*$feedback_lesson_point;

            $feedback['total'] = round($total, 2);
        }

        return $feedback->toArray();
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=owner
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Feedback $feedback)
    {
        if($feedback->owner)return $this->item($feedback->owner, new UserTransformer());
        else return $this->item(null, new QueryTransformer());
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=lesson
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeLesson(Feedback $feedback)
    {
        return $this->item($feedback->lesson, new LessonTransformer());
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=recipient
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeRecipient(Feedback $feedback)
    {
        if($feedback->recipient)return $this->item($feedback->recipient, new UserTransformer());
        else return $this->item(null, new QueryTransformer());
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=recipient
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeDonor(Feedback $feedback)
    {
        if($feedback->donor)return $this->item($feedback->donor, new UserTransformer());
        else return $this->item(null, new QueryTransformer());

    }


    /**
     * @param Lesson $feedback
     *
     * @get ?include=owner
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeGrades(Feedback $feedback)
    {
        return $this->collection($feedback->grades, new GradeTransformer());
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=comment
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeComment(Feedback $feedback)
    {
        if($feedback->comment)return $this->item($feedback->comment, new CommentTransformer());
        else return null;
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=recommendation
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeRecommendation(Feedback $feedback)
    {
        if($feedback->recommendation)return $this->item($feedback->recommendation, new CommentTransformer());
    }

}
