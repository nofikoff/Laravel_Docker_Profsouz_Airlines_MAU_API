<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_questions', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('post_id');
            $table->unsignedInteger('winner_id')->nullable();

            $table->dateTime('expiration_at')->nullable();

            $table->boolean('closed')->default(false);
            $table->unsignedInteger('default_option_id')->nullable();

/*            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');*/

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_questions');
    }
}
