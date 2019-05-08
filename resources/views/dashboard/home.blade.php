@extends('layouts.dashboard', ['subtitle' => 'Панель администратора'])

@section('content')
    <div class="row">
        <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-paper-plane"></i> Опубликовано опросов</span>
                <div class="count">{{ $publishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-clock-o"></i> Опросов в разработке</span>
                <div class="count">{{ $unpublishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-vcard-o"></i> Завершено опросов</span>
                <div class="count green">{{ $finishedFormsCount }}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Всего проголосовало</span>
                <div class="count">{{ $votePublishers }}</div>
            </div>
        </div>
    </div>
@endsection