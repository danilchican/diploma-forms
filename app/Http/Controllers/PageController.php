<?php

namespace App\Http\Controllers;

class PageController extends Controller
{

    public function showAboutPage()
    {
        return view('pages.about');
    }

    public function showContactsPage()
    {
        return view('pages.contacts');
    }
}
