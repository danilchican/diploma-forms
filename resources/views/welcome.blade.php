@extends('layouts.new_app', ['subtitle' => 'Главная'])

@section('content')
    <div class="page-header">
        <h1>Опросы</h1>
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
                {{ $forms->links() }}
            </div>
        </div>
    @else
        <p>Ни одного вопроса для голосания нет.</p>
    @endif
@endsection