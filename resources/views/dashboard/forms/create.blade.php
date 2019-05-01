@extends('layouts.dashboard', ['subtitle' => 'Опросы | Добавление нового опроса'])

@section('content')
    <create-form :answer-types="{{ $answerTypes }}" store-url="#" decline-url="#"></create-form>
@endsection