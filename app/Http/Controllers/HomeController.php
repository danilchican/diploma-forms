<?php

namespace App\Http\Controllers;

use App\Models\Form;

class HomeController extends Controller
{
    /**
     * Show Home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        return view('welcome')->with('forms', Form::published()->paginate());
    }
}
