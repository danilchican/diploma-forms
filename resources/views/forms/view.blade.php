@extends('layouts.new_app', ['subtitle' => ' Опросы - ' . $form->getTitle()])

@section('content')
    <h3>Опрос: {{ $form->getTitle() }}</h3>
    <p>Ответов: 0 {{--TODO add votes counts--}}</p>
    <p>{{ $form->getDescription() }}</p>
    <hr>
    {{--TODO add action--}}
    <form action="#" method="POST" id="add-form-vote">
        @foreach($questions->chunk(3) as $questionsChunk)
            <div class="row">
                @foreach($questionsChunk as $question)
                    <div class="col-md-6">
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
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Проголосовать</button>
    </form>
@endsection