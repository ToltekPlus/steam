<?php \Core\View::renderHeader(); ?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Просмотр пользователя</h1>
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
                    <tr>
                        <td><?=$item->phone?></td>
                        <td><?=$item->name_role?></td>
                        <td><?=$item->level?></td>
                        <td>
                            <form action="/block" method="POST">
                                <input type="hidden" value="<?=$item->table_id?>" name="id">
                                <button class="button is-small is-danger" type="submit">
                                    <ion-icon name="eye-off-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter(); ?>