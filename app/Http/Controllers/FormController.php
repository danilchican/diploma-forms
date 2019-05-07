<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormController extends Controller
{
    public function viewFormPage($id)
    {
        $form = Form::published()->findOrFail($id);
        return view('forms.view')->with('form', $form);
    }
}
