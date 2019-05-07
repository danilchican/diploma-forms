<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    const FORMS_PER_PAGE = 9;

    /**
     * Show Home page.
     *
     * @param Request $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage(Request $request)
    {
        return view('welcome')->with('forms', Form::published()->paginate(self::FORMS_PER_PAGE));
    }
}
