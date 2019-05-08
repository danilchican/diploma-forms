@extends('layouts.new_app', ['subtitle' => ' Опросы - ' . $form->getTitle()])

@section('content')
    <h3>Опрос: {{ $form->getTitle() }}</h3>
    <p>Проголосовало: {{ $answersCount }}</p>
    <p>{{ $form->getDescription() }}</p>
    <hr>
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-12">
            @include('partials.dashboard.messages')

            @if($isFinished)
                <div class="alert alert-warning">Голосование завершено.</div>
            @else
                @if($isAlreadySubmitted)
                    <div class="alert alert-warning">
                        Вы уже проходили данный опрос. Повторное голосование невозможно.
                    </div>
                @endif
            @endif
        </div>
        @if(!$isFinished)
            <div class="col-md-12">
                <div class="row">
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
            </div>
        @else
            <h3 style="text-align: center">Узнать результаты вы можете, скачав их в формате pdf.</h3>
            {{--TODO add button--}}
            <p style="text-align: center"><a href="#" class="btn btn-sm btn-success">Скачать результаты</a></p>
        @endif
    </div>
@endsection

@if($isAlreadySubmitted)
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                $('#add-form-vote').css('opacity', 0.5);
                $('#add-form-vote input:not([type=hidden])').attr('disabled', 'disabled');
                $('#add-form-vote textarea').attr('disabled', 'disabled');
                $('#add-form-vote select').attr('disabled', 'disabled');
                $('#add-form-vote button').attr('disabled', 'disabled');
            });
        </script>
    @endpush
@endif