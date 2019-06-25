<?php

namespace App\Containers\Feedback\Settings\Repositories;

use App\Containers\Feedback\Contracts\GradeRepositoryInterface;
use App\Containers\Feedback\Models\Grade;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class FeedbackRepository.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class GradeRepository extends Repository implements GradeRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'  => 'like',
        'user_id'  => '=',
    ];

    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Grade::class;
    }
}
