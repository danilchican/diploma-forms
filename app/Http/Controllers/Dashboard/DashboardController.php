<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\SubmittedForm;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $publishedFormsCount = Form::published()->count();
        $unpublishedFormsCount = Form::unpublished()->count();
        $finishedFormsCount = Form::finished()->count();
        $votePublishers = SubmittedForm::select('author_ip_address')
            ->groupBy('author_ip_address')
            ->get()
            ->count();

        return view('dashboard.home')->with(compact([
            'publishedFormsCount', 'finishedFormsCount', 'unpublishedFormsCount', 'votePublishers',
        ]));
    }
}
