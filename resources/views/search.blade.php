@extends('layouts.new_app', ['subtitle' => 'Результаты поиска'])

@section('content')
    <div class="page-header">
        <h2>Результаты поиска по запросу: "{{ Request::query('q') }}"</h2>
        <h4>Найдено совпадений: {{ $forms->total() }}</h4>
    </div>

    @if(count($forms))
        @foreach($forms->chunk(3) as $formChunk)
            <div class="row">
                <div class="col-md-12">
                    @each('partials.forms.grid_item', $formChunk, 'form')
                </div>
            </div>
        @endforeach
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                {{ $forms->appends(request()->input())->links() }}
            </div>
        </div>
    @else
        <p>По данному запросу не найдено ни одного опроса.</p>
        <p>Попробуйте найти опрос по его <b>названию</b> либо <b>описанию</b>.</p>
    @endif
@endsection