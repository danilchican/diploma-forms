<?php

namespace App\Http\Controllers;

use App\Models\Form;

class SearchController extends Controller
{
    const FORMS_PER_PAGE = 9;

    public function search()
    {
        if (request()->filled('q')) {
            $forms = Form::published()->search(request()->query('q'))->paginate(self::FORMS_PER_PAGE);
            return view('search')->with('forms', $forms);
        }

        abort(500);
    }
}
