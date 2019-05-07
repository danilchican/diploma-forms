<!-- Static navbar -->
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" style="padding: 9px" href="{{ route('index') }}">
                <img width="200" src="{{ asset('/images/logo.jpg') }}" alt="Кафедра менеджмента БГУИР">
            </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Route::currentRouteName() === 'index' ? 'active': '' }}">
                    <a href="{{ route('index') }}">Главная</a>
                </li>
                <li><a href="#">О кафедре</a></li>
                <li><a href="#">Контакты</a></li>
            </ul>
            <div class="col-md-6 pull-right">
                <div class="row">
                    <form action="{{ route('search') }}" id="ui-search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="q"
                                   placeholder="Введите название опроса для поиска...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Найти</button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
            </div>
        </div><!--/.nav-collapse -->
    </div>
</div>