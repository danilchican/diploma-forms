@extends('layouts.new_app', ['subtitle' => ' Опросы - ' . $form->getTitle()])

@section('content')
    <h3>Опрос: {{ $form->getTitle() }} <small style="vertical-align: super;">0{{--TODO add votes counts--}}</small></h3>
    <p>{{ $form->getDescription() }}</p>
    <hr>
    @foreach($questions->chunk(3) as $questionsChunk)
        <div class="row">
            @foreach($questionsChunk as $question)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $loop->iteration . '. ' . $question->getTitle() }}
                        </div>
                        <div class="panel-body">
                            Panel content
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection