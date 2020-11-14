<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('branch_id');

            $table->string('title');
            $table->string('type');
            $table->longText('body')->nullable();

            $table->string('status')->nullable();

            $table->integer('info_status_id')->nullable()->unsigned();

            $table->boolean('importance')->dafault(false);
            $table->boolean('is_commented')->default(true);
            $table->boolean('sms_notify')->default(false);
            $table->boolean('in_top')->default(false);

            /*$table->foreign('branch_id')->references('id')->on('branches')
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
        Schema::dropIfExists('posts');
    }
}
