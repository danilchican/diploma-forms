@extends('layouts.new_app', ['subtitle' => ' Опросы - ' . $form->getTitle()])

@section('content')
    <h3>Опрос: {{ $form->getTitle() }}</h3>
    <p>Ответов: 0 {{--TODO add votes counts--}}</p>
    <p>{{ $form->getDescription() }}</p>
    <hr>
    <div class="col-md-8 col-md-offset-2">
        @include('partials.dashboard.messages')

        <form action="{{ route('forms.submit') }}" method="POST" id="add-form-vote">
            <input type="hidden" name="form-id" value="{{ $form->id }}">

            {{ csrf_field() }}

            @foreach($questions as $question)
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $loop->iteration . '. ' . $question->getTitle() }}
                            @if($question->isRequired())
                                <span class="required" style="color: red;">*</span>
                            @endif
                        </div>
                        <div class="panel-body">
                            @if($question->isNeedToChooseAnswer())
                                @include('partials.forms.view.choice')
                            @else
                                @include('partials.forms.view.' . $question->answerType->type)
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Проголосовать</button>
            </div>
        </form>
    </div>
@endsection