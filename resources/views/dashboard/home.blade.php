@extends('layouts.dashboard', ['subtitle' => 'Панель администратора'])

@section('content')
    <div class="row">
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-paper-plane"></i> Опубликовано опросов</span>
                <div class="count green">{{ $publishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Опросов в разработке</span>
                <div class="count">{{ $unpublishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-check"></i> Завершено опросов</span>
                <div class="count green">{{ $finishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Всего проголосовало</span>
                <div class="count">{{ $votePublishers }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-vcard-o"></i> Количество шаблонов</span>
                <div class="count">{{ $templatesCount }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Шаблоны опросов</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @include('partials.dashboard.messages')

                    <div class="table-responsive">
                        @if(count($templates))
                            @include('partials.dashboard.templates.list')
                        @else
                            На данный момент шаблонов нет.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection