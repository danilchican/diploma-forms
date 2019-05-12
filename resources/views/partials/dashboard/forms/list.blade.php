<table class="table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th>Заголовок</th>
        <th>Автор</th>
        <th>Окончен</th>
        <th>Опубликован</th>
        <th>Дата создания</th>
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
                <a href="{{ route('dashboard.forms.view', ['id' => $form->id]) }}"
                   class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="bottom"
                   data-original-title="Посмотреть результаты"><i class="fa fa-eye" style="font-size: 14px;"></i></a>
                <a href="{{ route('dashboard.forms.delete') }}"
                   onclick="event.preventDefault(); document.getElementById('delete-form-{{ $form->id }}').submit();"
                   class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="bottom"
                   data-original-title="Удалить опрос"><i class="fa fa-trash" style="font-size: 14px;"></i></a>

                <form id="delete-form-{{ $form->id }}" action="{{ route('dashboard.forms.delete') }}" method="POST"
                      style="display: none;">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $form->id }}">
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>