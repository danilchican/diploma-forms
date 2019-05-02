<table class="table table-striped no-margin">
    <thead>
    <tr>
        <th>#</th>
        <th>Заголовок</th>
        <th>Автор</th>
        <th>Окончен</th>
        <th>Дата создания</th>
        {{--TODO добавить кол-во проголосовавших--}}
        {{--<th>TODO Действие</th>--}}
    </tr>
    </thead>
    <tbody>

    @foreach($forms as $form)
        <tr>
            <td>{{ $form->id }}</td>
            <td>{{ $form->getTitle() }}</td>
            <td>{{ $form->author === null ? 'нету' : $form->author->getName() }}</td>
            <td>{{ $form->isFinished() ? 'да' : 'нет' }}</td>
            <td><i>{{ $form->getCreatedDate()->format('m.d.Y H:i') }}</i></td>
            {{--<td>TODO add links</td>--}}
        </tr>
    @endforeach
    </tbody>
</table>