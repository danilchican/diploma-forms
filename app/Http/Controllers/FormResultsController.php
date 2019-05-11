<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormResultsController extends Controller
{
    use StatisticsTrait;

    public function downloadResultsInPDF($id)
    {
        $relations = $this->getStatisticsRelations();
        $form = Form::with($relations)->findOrFail($id);

        $pdf = \PDF::loadView('forms.results');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('chart.pdf');
    }
}
