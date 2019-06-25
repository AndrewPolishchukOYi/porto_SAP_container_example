<?php

namespace App\Containers\Feedback\Settings\Repositories;

use App\Containers\Feedback\Contracts\CriteriaRepositoryInterface;
use App\Containers\Feedback\Models\Criteria;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class FeedbackRepository.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class CriteriaRepository extends Repository implements CriteriaRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [

        'role_id'  => '=',
        'status'  => '=',
        'name'  => 'like',
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Criteria::class;
    }
}
