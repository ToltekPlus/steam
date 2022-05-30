<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Игры</h1>
            <ul>
                <li>
                    <a href="/games/add">Добавить игру</a>
                </li>
            </ul>
            <table class="table">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Базовая цена</th>
                    <th>Скидка</th>
                    <th>Видимость</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($games as $game) : ?>
                    <tr>
                        <td><?=$game->name_game;?></td>
                        <td><?=$game->base_price;?></td>
                        <td>
                            <a href="/taxes/edit?id=<?=$game->id?>">
                                <ion-icon name="pricetag-outline"></ion-icon>
                            </a>
                        </td>
                        <td>
                            <a href="/games/visibility?id=<?=$game->id?>">
                                <ion-icon name=<?php echo $game->visibility == 1 ? "eye-outline" : "eye-off-outline";?>></ion-icon>
                            </a>
                        </td>
                        <td>
                            <a href="/games/edit?id=<?=$game->id?>">
                                <ion-icon name="pencil-outline"></ion-icon>
                            </a>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>
