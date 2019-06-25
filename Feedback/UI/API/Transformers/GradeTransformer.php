<?php

namespace App\Containers\Feedback\UI\API\Transformers;

use App\Containers\Feedback\Models\Grade;
use App\Port\Transformer\Abstracts\Transformer;
use App\Containers\User\UI\API\Transformers\UserTransformer;

use App\Port\Transformer\Eloquent\QueryTransformer;

/**
 * Class FeedbackTransformer.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class GradeTransformer extends Transformer
{
    protected $availableIncludes = [
          'criteria'
    ];

    protected $defaultIncludes = [

    ];

    /**
     * @param \App\Containers\Feedback\Models\Grade $grade
     *
     * @return array
     */
    public function transform(Grade $grade)
    {

        $grade['name'] = $grade->criteria->name;

        return $grade->toArray();
    }

    /**
     * @param Lesson $grade
     *
     * @get ?include=owner
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeOwner(Grade $grade)
    {
        if($grade->owner)return $this->item($grade->owner, new UserTransformer());
        else return $this->item(null, new QueryTransformer());
    }

}
