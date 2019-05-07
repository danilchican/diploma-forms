<label for="question-{{ $question->id }}">
    @if($question->answerType->type !== 'checkbox')
        Выберите вариант ответа:
    @else
        Выберите несколько вариантов ответа:
    @endif
</label>

@if($question->answerType->type === 'select')
    <select id="question-{{ $question->id }}" name="answers[{{ $question->id }}]" class="form-control">
        @foreach($question->answers as $answer)
            <option value="{{ $answer->id }}">{{ $answer->getTitle() }}</option>
        @endforeach
    </select>
@else
    @foreach($question->answers as $answer)
        <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label for="answer-{{ $answer->id }}">
                    <input id="answer-{{ $answer->id }}" type="{{ $question->answerType->type }}"
                           value="{{ $answer->id }}" name="answers[{{ $question->id }}][]"> {{ $answer->getTitle() }}
                </label>
            </div>
        </div>
    @endforeach
@endif