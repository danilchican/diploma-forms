<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AnswerType;
use App\Models\Form;

class FormController extends Controller
{
    public function showCreateFormPage()
    {
        return view('dashboard.forms.create')->with('answerTypes', AnswerType::all());
    }

    public function showFormsListPage()
    {
        $forms = Form::with('author')->paginate();
        return view('dashboard.forms.index')->with('forms', $forms);
    }
}
