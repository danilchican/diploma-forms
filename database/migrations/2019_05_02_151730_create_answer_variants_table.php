<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_variants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->unsignedInteger('form_question_id');
            $table->foreign('form_question_id')->references('id')->on('form_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_variants');
    }
}
