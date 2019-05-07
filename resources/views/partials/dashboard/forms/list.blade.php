<table class="table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th>Заголовок</th>
        <th>Автор</th>
        <th>Окончен</th>
        <th>Опубликован</th>
        <th>Дата создания</th>
        {{--TODO добавить кол-во проголосовавших--}}
        <th>Действие</th>
    </tr>
    </thead>
    <tbody>

    @foreach($forms as $form)
        <tr>
            <td>{{ $form->id }}</td>
            <td>{{ $form->getTitle() }}</td>
            <td>{{ $form->author === null ? 'нету' : $form->author->getName() }}</td>
            <td>{{ $form->isFinished() ? 'да' : 'нет' }}</td>
            <td>{{ $form->isPublished() ? 'да' : 'нет' }}</td>
            <td><i>{{ $form->getCreatedDate()->format('m.d.Y H:i') }}</i></td>
            <td>
                <a href="{{ route('dashboard.forms.edit', ['id' => $form->id]) }}"
                   class="btn btn-xs btn-warning" data-toggle="tooltip" data-placement="bottom"
                   data-original-title="Редактировать"><i class="fa fa-pencil" style="font-size: 14px;"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>