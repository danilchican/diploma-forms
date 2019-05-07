<div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <input placeholder="Введите ответ" class="form-control"
               @if($question->isRequired()) required="required" @endif>
    </div>
</div>