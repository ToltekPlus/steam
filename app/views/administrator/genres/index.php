<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Жанры</h1>
            <ul>
                <li>
                    <a href="/genres/add">Добавить жанр</a>
                </li>
            </ul>
            <table>
                <tr>
                    <th>Жанры</th>
                    <th></th>
                </tr>

                <?php foreach ($genres as $genre) : ?>
                    <tr>
                        <td><?=$genre->name_genre;?></td>
                        <td>
                            <a href="/genres/edit?id=<?=$genre->id?>">Редактировать</a>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>