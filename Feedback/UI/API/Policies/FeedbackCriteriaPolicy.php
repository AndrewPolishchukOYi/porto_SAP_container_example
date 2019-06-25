<?php

namespace App\Containers\Feedback\UI\API\Policies;

use App\Port\Policy\Abstracts\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Containers\User\Models\User;
use App\Containers\Feedback\Models\Criteria;
use Exception;

/**
 * Class FeedbackPolicy.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackCriteriaPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     *
     * @param \App\Containers\User\Models\User $user
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return bool
     */
    public function update($user, Criteria $criteria, $request)
    {
        // array of attribute for updating
        $diff = array_diff_assoc($request->all(),$criteria->toArray());

        if(($criteria['status'] == Criteria::STATUS_ACTIVE && !isset($diff['status'])) || $criteria['status'] == Criteria::STATUS_ACTIVE && isset($diff['status'])){
            // return error if try edit hidden fields when plan is activated
            $hidden = [
                "name" => "Name",
//                "display_name" => "Display name",
                "points" => "Points",
//                "description" => "Description"
            ];

            $result = array_intersect_key($hidden,$diff);

            if(count($result)) throw new Exception('When criteria is activated next fields are not editable : '
                .implode(', ',array_values($hidden)) .".You modified fields:".implode(', ',$result).".");
        }

        if($criteria['status'] == Criteria::STATUS_INACTIVE && $criteria->grades->count()){
            // return error if try edit hidden fields when plan is deactivated and he has subscriptions
            $hidden = [
                "name" => "Name",
//                "display_name" => "Display name",
                "points" => "Points",
//                "description" => "Description"
            ];

            $result = array_intersect_key($hidden,$diff);

            if(count($result)) throw new Exception('When plan has relations next fields are not editable : '
                .implode(', ',array_values($hidden)) .".You modified fields:".implode(', ',$result).".");
        }
        // authorize only if a user is updating it's own records
//        if($criteria->grades->count()) throw new Exception('Exist feedbacks with current criteria!('.$criteria->grades->count().')');
        return true;
    }

    /**
     *
     * @param \App\Containers\User\Models\User $user
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return bool
     */
    public function delete(Criteria $criteria)
    {
        // authorize only if a user is deleting it's own records
        if($criteria->grades->count()) throw new Exception('Exist feedbacks with current criteria!('.$criteria->grades->count().')');
        return true;
    }
}
