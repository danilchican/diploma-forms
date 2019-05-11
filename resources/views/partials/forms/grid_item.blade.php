<div class="col-md-4 form-item">
    <div class="panel panel-primary" style="min-height: 230px; position: relative">
        <div class="panel-heading">
            <h3 class="panel-title" style="font-size:14px">
                <a href="{{ route('forms.view', ['id' => $form->id]) }}">
                    {{ $form->getTitle() }}
                </a>
            </h3>
        </div>
        <div class="panel-body">
            <p>{{ $form->getDescription() }}</p>
            <div class="form-item-footer">
                <hr/>
                <span style="color: #989898">
                    <i>Дата создания: {{ $form->getCreatedDate()->format('m.d.Y H:i') }}</i>
                </span>
                {{--TODO add downloading results --}}
                @if($form->isFinished())
                    <span class="pull-right">
                        <a href="{{ route('forms.results.download', ['id' => $form->id]) }}"
                           class="btn btn-xs btn-success" title="Скачать результаты">
                            <i class="fa fa-download"></i>
                        </a>
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>