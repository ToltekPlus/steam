<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Жанры</h1>
            <ul>
                <li>
                    <a href="/genres/add">Добавить жанр</a>
                </li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>Иконка</th>
                        <th>Жанр</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($genres as $genre) : ?>
                        <tr>
                            <td>
                                <img src="/images/administrator/<?=$genre->icon_genre;?>" alt="<?=$genre->name_genre;?>">
                            </td>
                            <td><?=$genre->name_genre;?></td>
                            <td>
                                <a href="/genres/edit?id=<?=$genre->id?>">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
                            </td>
                            <td style="width: 80px; text-align: center;">
                                <form action="/delete" method="POST">
                                    <input type="hidden" value="<?=$genre->id?>" name="id">
                                    <button class="button is-small is-danger" type="submit">
                                        <ion-icon name="close-outline"></ion-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>