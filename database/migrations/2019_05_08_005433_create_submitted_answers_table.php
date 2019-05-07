<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmittedAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_answers', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('submitted_form_id');
            $table->foreign('submitted_form_id')->references('id')->on('submitted_forms');

            $table->unsignedInteger('form_question_id');
            $table->foreign('form_question_id')->references('id')->on('form_questions');

            $table->unsignedInteger('selected_answer_variant_id')->nullable();
            $table->foreign('selected_answer_variant_id')->references('id')->on('answer_variants');

            $table->text('text_answer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitted_answers');
    }
}
