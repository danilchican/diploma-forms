<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswerVariantTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_variant_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');

            $table->unsignedInteger('form_template_question_id');
            $table->foreign('form_template_question_id')->references('id')->on('form_template_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_variant_templates');
    }
}
