@extends('layouts.dashboard', ['subtitle' => 'Опросы | Добавление нового опроса'])

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Добавление нового опроса</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @include('partials.dashboard.messages')
                    {{--TODO change store url--}}
                    <create-form store-url="#"></create-form>
                </div>
            </div>
        </div>
    </div>
@endsection