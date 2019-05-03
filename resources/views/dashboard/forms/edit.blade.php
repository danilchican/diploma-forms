@extends('layouts.dashboard', ['subtitle' => 'Опросы | Редактирование опроса #' . $form->id])

@section('content')
    <edit-form :answer-types="{{ $answerTypes }}"
               :form="{{ $form }}"
               delete-question-url="{{ route('dashboard.questions.delete') }}"
               update-url="{{ route('dashboard.forms.update') }}"></edit-form>
@endsection