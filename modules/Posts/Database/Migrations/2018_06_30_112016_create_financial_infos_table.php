<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id');
            $table->string('pdf_rr')->nullable();
            $table->string('pdf_mfo')->nullable();
            $table->string('pdf_card')->nullable();
            $table->string('pdf_bank')->nullable();
            $table->string('pdf_edrpoy')->nullable();
            $table->string('pdf_extradited')->nullable();
            $table->string('pdf_passport_code')->nullable();
            $table->string('pdf_passport_seria')->nullable();
            $table->string('pdf_identification')->nullable();
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
        Schema::dropIfExists('financial_infos');
    }
}
