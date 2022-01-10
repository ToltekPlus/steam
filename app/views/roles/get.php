<?php \Core\View::renderHeader(); ?>

    <table>
        <caption>Сводная таблица пользователей</caption>
        <tr>
            <th>Телефон</th>
            <th>Роль</th>
            <th>Уровень</th>
        </tr>

        <tr>
            <td><?=$user->phone?></td>
            <td><?=$user->role?></td>
            <td><?=$user->level?></td>
        </tr>
    </table>

<?php \Core\View::renderFooter(); ?>