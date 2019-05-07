<div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="text" placeholder="Введите ответ" class="form-control"
               name="answers[{{ $question->id }}]" @if($question->isRequired()) required="required" @endif>
    </div>
</div>