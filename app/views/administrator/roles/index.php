<?php \Core\View::renderHeader(); ?>
<section class="columns is-full is-centered is-vertical catalog">
    <section class="column is-8 filter">
        <h1>Пользователи</h1>
        <ul>
            <li>
                <a href="#">Добавить нового пользователя</a>
            </li>
        </ul>
        <table class="table">
            <thead>
            <tr>
                <th>Телефон</th>
                <th>Роль</th>
                <th>Уровень</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $item): ?>
                <tr>
                    <td><?=$item->phone?></td>
                    <td><?=$item->name_role?></td>
                    <td><?=$item->level?></td>
                    <td>
                        <a href="/roles/role?id=<?=$item->table_id?>">
                            <ion-icon name="eye-outline"></ion-icon>
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </section>
</section>
<?php \Core\View::renderFooter(); ?>