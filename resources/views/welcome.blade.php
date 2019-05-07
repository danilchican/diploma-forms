@extends('layouts.new_app', ['subtitle' => 'Главная'])

@section('content')
    <div class="page-header">
        <h1>Опросы</h1>
    </div>

    @if(count($forms))
        @foreach($forms->chunk(3) as $formChunk)
            <div class="row">
                <div class="col-md-12">
                    @foreach($formChunk as $form)
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title" style="font-size:14px">
                                        <a href="">{{ $form->getTitle() }}</a>
                                    </h3>
                                </div>
                                <div class="panel-body" style="min-height: 150px">
                                    <p>{{ $form->getDescription() }}</p>
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
        <p>Ни одного вопроса для голосания нет.</p>
    @endif
@endsection