<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostQuestionVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_question_votes', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('post_question_id');

            $table->unsignedInteger('post_question_option_id');

            /*$table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('post_question_id')->references('id')->on('post_questions')
                ->onDelete('cascade');
            $table->foreign('post_question_option_id')->references('id')->on('post_question_options')
                ->onDelete('cascade');*/

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_question_votes');
    }
}
