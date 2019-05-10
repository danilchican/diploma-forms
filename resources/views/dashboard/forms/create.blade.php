@extends('layouts.dashboard', ['subtitle' => 'Опросы | Добавление нового опроса'])

@section('content')
    <create-form :answer-types="{{ $answerTypes }}"
                 :use-template="{{ $hasTemplate ? 'true' : 'false' }}"
                 @if($hasTemplate)
                 :template="{{ $template }}"
                 @endif
                 store-url="{{ route('dashboard.forms.store') }}"></create-form>
@endsection