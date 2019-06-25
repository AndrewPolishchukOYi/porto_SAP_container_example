<?php

namespace App\Containers\Feedback\Database\Criterias;

use App\Port\Criterias\Abstracts\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;


class FeedbackCriteria extends Criteria
{
    /**
     * @param $model
     * @param PrettusRepositoryInterface $repository
     * @return mixed
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model;
    }
}