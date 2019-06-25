<?php

namespace App\Containers\Feedback\Actions;

use App\Containers\Feedback\Contracts\GradeRepositoryInterface;
use App\Containers\Feedback\Database\Criterias\GradeChartCriteria;
use App\Port\Action\Abstracts\Action;

/**
 * Class ListAllFeedbackAction.
 *
 * @author Vasyl Perun <perun.vasyl1@gmail.com>
 */
class ListAllGradesAction extends Action
{

    /**
     * @var \App\Containers\Feedback\Contracts\GradeRepositoryInterface
     */
    private $gradeRepository;

    /**
     * ListAllFeedbackAction constructor.
     *
     * @param \App\Containers\Feedback\Contracts\GradeRepositoryInterface $gradeRepository
     */
    public function __construct(GradeRepositoryInterface $gradeRepository)
    {
        $this->gradeRepository = $gradeRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        $grade = $this->gradeRepository;

        return $grade;
    }

    /**
     * @return mixed
     */
    public function chart()
    {
        $grade = $this->gradeRepository->pushCriteria(new GradeChartCriteria())->all();

        $grade = $grade->map( function ($item) {
            return [
                'points' => $item->points,
                'lesson_due_date' => $item->feedback->lesson->due_date->toDateTimeString(),
                'criteris_name' => $item->criteria->name
            ];
        })
        ->groupBy('criteris_name');

        return $grade;
    }
}
