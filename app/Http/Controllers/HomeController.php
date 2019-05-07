<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show Home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showHomePage()
    {
        return view('welcome');
    }
}
