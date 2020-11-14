<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('branch_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->string('file');
            $table->string('url');
            $table->string('size');

            $table->string('description')->nullable();
            $table->string('status');
            $table->boolean('importance');
            $table->boolean('is_notify');
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
        Schema::dropIfExists('documents');
    }
}
