<table class="table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th>Заголовок</th>
        <th>Количество вопросов</th>
        <th>Дата создания</th>
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>

    @foreach($templates as $template)
        <tr>
            <td>{{ $template->id }}</td>
            <td>{{ $template->getTitle() }}</td>
            <td>{{ $template->questions_count }}</td>
            <td><i>{{ $template->getCreatedDate()->format('m.d.Y H:i') }}</i></td>
            <td>
                <a href="{{ route('dashboard.forms.edit', ['id' => $template->id]) }}"
                   class="btn btn-xs btn-primary">
                    <i class="fa fa-check" style="font-size: 14px;"></i> Использовать шаблон
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>