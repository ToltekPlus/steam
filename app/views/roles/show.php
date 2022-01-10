<?php \Core\View::renderHeader(); ?>

<table>
    <caption>Сводная таблица пользователей</caption>
    <tr>
        <th>Телефон</th>
        <th>Роль</th>
        <th>Уровень</th>
        <th></th>
    </tr>

    <?php foreach ($users as $item): ?>
        <tr>
            <td><?=$item->phone?></td>
            <td><?=$item->role?></td>
            <td><?=$item->level?></td>
            <td>
                <a href="/roles/role?id=<?=$item->id?>">
                    Смотреть
                </a>
            </td>
        </tr>
    <?php endforeach;?>
</table>

<?php \Core\View::renderFooter(); ?>