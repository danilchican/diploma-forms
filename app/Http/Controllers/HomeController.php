<?php

namespace App\Http\Controllers;

use App\Models\Form;

class HomeController extends Controller
{
    const FORMS_PER_PAGE = 9;
    /**
     * Show Home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        return view('welcome')->with('forms', Form::published()->paginate(self::FORMS_PER_PAGE));
    }
}
