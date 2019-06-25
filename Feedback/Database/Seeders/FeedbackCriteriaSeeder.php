<?php

namespace App\Containers\Feedback\Database\Seeders;

use App\Containers\Feedback\Models\Criteria;
use App\Port\Seeder\Abstracts\Seeder;

/**
 * Class FeedbackSeeder
 *
 * @author  Vasyl Perun  <perun.vasyl1@gmail.com>
 */
class FeedbackCriteriaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria_fluency = new Criteria();
        $criteria_fluency->name = 'fluency';
        $criteria_fluency->display_name = 'Fluency';
        $criteria_fluency->description = 'Fluency of student';
        $criteria_fluency->role_id = 3;
        $criteria_fluency->points = 5;
        $criteria_fluency->save();

        $criteria_comprehension = new Criteria();
        $criteria_comprehension->name = 'comprehension';
        $criteria_comprehension->display_name = 'Comprehension';
        $criteria_comprehension->description = 'Comprehension of student';
        $criteria_comprehension->role_id = 3;
        $criteria_comprehension->points = 5;
        $criteria_comprehension->save();

        $criteria_grammar = new Criteria();
        $criteria_grammar->name = 'grammar';
        $criteria_grammar->display_name = 'Grammar';
        $criteria_grammar->description = 'Grammar of student';
        $criteria_grammar->role_id = 3;
        $criteria_grammar->points = 5;
        $criteria_grammar->save();

        $criteria_vocabulary = new Criteria();
        $criteria_vocabulary->name = 'vocabulary';
        $criteria_vocabulary->display_name = 'Vocabulary';
        $criteria_vocabulary->description = 'Vocabulary of student';
        $criteria_vocabulary->role_id = 3;
        $criteria_vocabulary->points = 5;
        $criteria_vocabulary->save();

        $criteria_pronunciation = new Criteria();
        $criteria_pronunciation->name = 'pronunciation';
        $criteria_pronunciation->display_name = 'Pronunciation';
        $criteria_pronunciation->description = 'Pronunciation of student';
        $criteria_pronunciation->role_id = 3;
        $criteria_pronunciation->points = 5;
        $criteria_pronunciation->save();


        $teacher_criteria_1 = new Criteria();
        $teacher_criteria_1->name = 'informative';
        $teacher_criteria_1->display_name = 'Informative';
        $teacher_criteria_1->description = 'The presentation of information teacher';
        $teacher_criteria_1->role_id = 4;
        $teacher_criteria_1->points = 5;
        $teacher_criteria_1->save();

        $teacher_criteria_2 = new Criteria();
        $teacher_criteria_2->name = 'assessment';
        $teacher_criteria_2->display_name = 'Assessment';
        $teacher_criteria_2->description = 'Assessment of student';
        $teacher_criteria_2->role_id = 4;
        $teacher_criteria_2->points = 5;
        $teacher_criteria_2->save();

    }
}
