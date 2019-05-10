<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormTemplateRelationToFormTemplateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_template_questions', function (Blueprint $table) {
            $table->unsignedInteger('form_template_id')->after('answer_type_id');
            $table->foreign('form_template_id')->references('id')->on('form_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_template_questions', function (Blueprint $table) {
            $table->dropForeign('form_template_id');
            $table->dropColumn('form_template_id');
        });
    }
}
