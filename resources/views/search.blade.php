@extends('layouts.new_app', ['subtitle' => 'Результаты поиска'])

@section('content')
    <div class="page-header">
        <h1>Результаты поиска</h1>
    </div>

    @if(count($forms))
        @foreach($forms->chunk(3) as $formChunk)
            <div class="row">
                <div class="col-md-12">
                    @foreach($formChunk as $form)
                        <div class="col-md-4 form-item">
                            <div class="panel panel-primary" style="min-height: 230px; position: relative">
                                <div class="panel-heading">
                                    <h3 class="panel-title" style="font-size:14px">
                                        <a href="">{{ $form->getTitle() }}</a>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p>{{ $form->getDescription() }}</p>
                                    <div class="form-item-footer">
                                        <hr/>
                                        {{--TODO add votes counts--}}
                                        <span style="color: #989898"><i>Проголосовало: 0</i></span>
                                        {{--TODO add downloading results --}}
                                        {{--TODO add condition to show button votes > 0 --}}
                                        <span class="pull-right">
                                        <a href="#" class="btn btn-xs btn-success" title="Скачать результаты">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                {{ $forms->links() }}
            </div>
        </div>
    @else
        <p>По данному запросу не найдено ни одной анкеты.</p>
        <p>Попробуйте найти анкету по её <b>названию</b> либо <b>описанию</b>.</p>
    @endif
@endsection