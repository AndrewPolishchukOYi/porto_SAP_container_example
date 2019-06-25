<?php

namespace App\Containers\Feedback\Settings\Repositories;

use App\Containers\Feedback\Contracts\FeedbackRepositoryInterface;
use App\Containers\Feedback\Models\Feedback;
use App\Port\Repository\Abstracts\Repository;

/**
 * Class FeedbackRepository.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class FeedbackRepository extends Repository implements FeedbackRepositoryInterface
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
        return Feedback::class;
    }
}
