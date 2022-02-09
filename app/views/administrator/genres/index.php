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
                    <th></th>
                </tr>

                <?php foreach ($genres as $genre) : ?>
                    <tr>
                        <td><?=$genre->name_genre;?></td>
                        <td>
                            <a href="/genres/edit?id=<?=$genre->id?>">Редактировать</a>
                        </td>
                        <td style="width: 80px; text-align: center;">
                            <!--<a href="/genres/delete?id=<?=$genre->id?>">X</a>-->
                            <form action="/delete" method="POST">
                                <input type="hidden" value="<?=$genre->id?>" name="id">
                                <button type="submit">X</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach;?>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>