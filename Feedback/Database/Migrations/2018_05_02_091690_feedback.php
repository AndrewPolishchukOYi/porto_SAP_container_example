<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Feedback extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('lesson_id')->unsigned();
            $table->integer('recipient_id')->unsigned();
            $table->foreign('lesson_id')->references('id')
                ->on('class_has_lesson')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')
                ->on('users')->onDelete('cascade');
            $table->boolean('attend')->default(true);
            $table->integer('comment_id')->unsigned();
            $table->integer('recommendation_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->index(['user_id', 'lesson_id', 'recipient_id']);
        });

        Schema::create('feedback_criterias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('description');
            $table->integer('role_id')->unsigned();
            $table->integer('points')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            $table->index(['role_id']);
        });

        Schema::create('feedback_grades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feedback_id')->unsigned();
            $table->integer('criteria_id')->unsigned();
            $table->foreign('feedback_id')->references('id')
                ->on('feedbacks')->onDelete('cascade');
            $table->foreign('criteria_id')->references('id')
                ->on('feedback_criterias')->onDelete('cascade');
            $table->integer('points')->unsigned();
            $table->timestamps();
            $table->index(['feedback_id', 'criteria_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
