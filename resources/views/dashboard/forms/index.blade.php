@extends('layouts.dashboard', ['subtitle' => 'Опросы'])

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <div class="page-title" style="padding: 0; height:auto;">
                <div class="title_left">
                    <a href="{{ route('dashboard.forms.create') }}" class="btn btn-primary">
                        Создать опрос
                    </a>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2>Опросы</h2>
                    <span class="nav-no-margin pull-right">
                        {{ $forms->links() }}
                    </span>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @include('partials.dashboard.messages')

                    <div class="table-responsive">
                        @if(count($forms))
                            @include('partials.dashboard.forms.list')
                        @else
                            На данный момент опросов нет.
                        @endif
                    </div>
                    <span class="nav-no-margin pull-right">
                        {{ $forms->links() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
@endsection