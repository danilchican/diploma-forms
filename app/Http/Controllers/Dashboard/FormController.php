<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FormController extends Controller
{
    public function showCreateFormPage()
    {
        return view('dashboard.forms.create');
    }
}
