<?php

namespace App\Containers\Feedback\Database\Seeders;

use App\Containers\Feedback\Models\Feedback;
use App\Port\Seeder\Abstracts\Seeder;

/**
 * Class FeedbackSeeder
 *
 * @author  Vasyl Perun  <perun.vasyl1@gmail.com>
 */
class FeedbackSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $feedback = new Settings();
         $feedback->field_1 = 'field_1 value';
         $feedback->field_2 = 'field_2 value';
         $feedback->save();

    }
}
