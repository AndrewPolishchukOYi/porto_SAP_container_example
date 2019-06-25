<?php

namespace App\Containers\Feedback\UI\API\Transformers;

use App\Containers\Feedback\Models\Criteria;
use App\Port\Transformer\Abstracts\Transformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;
use App\Containers\Role\UI\API\Transformers\RoleTransformer;

use App\Port\Transformer\Eloquent\QueryTransformer;

/**
 * Class FeedbackTransformer.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CriteriaTransformer extends Transformer
{
    protected $availableIncludes = [
        'owner',
        'role'
    ];

    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\Feedback\Models\Feedback $feedback
     *
     * @return array
     */
    public function transform(Criteria $criteria)
    {
        return $criteria->toArray();
    }

    /**
     * @param Lesson $feedback
     *
     * @get ?include=owner
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Criteria $criteria)
    {
        if($criteria->owner)return $this->item($criteria->owner, new UserTransformer());
        else return $this->item(null, new QueryTransformer());
    }

    /**
     * @param Level $level
     * @return \League\Fractal\Resource\Item
     */
    public function includeRole(Criteria $criteria)
    {
        if($criteria->role)return $this->item($criteria->role, new RoleTransformer());
        else return $this->item(null, new QueryTransformer());
    }

}
