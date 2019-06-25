<?php

namespace App\Containers\Feedback\UI\API\Policies;

use App\Containers\CourseClass\Models\Lesson;
use App\Port\Policy\Abstracts\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Containers\User\Models\User;
use App\Containers\Feedback\Models\Feedback;
use \Carbon\Carbon;
use Exception;


/**
 * Class FeedbackPolicy.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     *
     * @param \App\Containers\User\Models\User $user
     * @param \App\Containers\Course\Models\Course $course
     *
     * @return bool
     */
    public function create(User $user, $params)
    {

        $lesson = Lesson::find($params['lesson_id']);
        // check if lesson in past
        if($lesson->due_date->addSeconds($lesson->program->duration) > Carbon::now())
            throw new Exception("Current lesson is run or in future!");
        // authorize only if a user is updating it's own records
        return true;
//        return $user->id == $course->user_id;
    }

    /**
     *
     * @param \App\Containers\User\Models\User $user
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return bool
     */
    public function update(User $user, Feedback $feedback)
    {
        // authorize only if a user is updating it's own records
        return $user->id == $feedback->user_id;
    }

    /**
     *
     * @param \App\Containers\User\Models\User $user
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return bool
     */
    public function delete(User $user, Feedback $feedback)
    {
        // authorize only if a user is deleting it's own records
        return $user->id == $feedback->user_id;
    }
}
