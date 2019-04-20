<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormTemplateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_template_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->unsignedInteger('answer_type_id');

            $table->foreign('answer_type_id')->references('id')->on('answer_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_template_questions');
    }
}
