<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormController extends Controller
{
    public function viewFormPage($id)
    {
        $form = Form::published()->with(['questions', 'questions.answerType', 'questions.answers'])->findOrFail($id);
        $questions = $form->questions;
        return view('forms.view')->with(compact(['form', 'questions']));
    }
}
