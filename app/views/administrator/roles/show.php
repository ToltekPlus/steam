<?php \Core\View::renderHeader(); ?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
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
                        <td><?=$item->name_role?></td>
                        <td><?=$item->level?></td>
                        <td>
                            <a href="/roles/role?id=<?=$item->id?>">
                                Смотреть
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter(); ?>
