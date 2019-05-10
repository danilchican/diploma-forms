@extends('layouts.dashboard', ['subtitle' => 'Результаты опроса'])

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Результаты опроса "{{ $form->getTitle() }}"</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form-results :form-questions="{{ $questionsWithAnswers }}"></form-results>
                </div>
            </div>
        </div>
    </div>
@endsection