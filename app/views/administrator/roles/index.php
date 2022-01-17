<?php \Core\View::renderHeader(); ?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
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
        </section>
    </section>

<?php \Core\View::renderFooter(); ?>