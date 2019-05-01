<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AnswerType;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function showCreateFormPage()
    {
        return view('dashboard.forms.create')->with('answerTypes', AnswerType::all());
    }
}
