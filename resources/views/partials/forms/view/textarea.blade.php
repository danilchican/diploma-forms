<div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <textarea placeholder="Введите ответ" class="form-control" rows="4"
                  @if($question->isRequired()) required="required" @endif></textarea>
    </div>
</div>