<?php \Core\View::renderHeader(); ?>

<section class="columns is-full is-centered is-vertical catalog-block">
    <div class="column is-8">
        <div class="columns is-multiline">

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Игра</th>
                        <th>Дата покупки</th>
                        <th>Дата возврата</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td>
                            <?=$order->id?>
                        </td>
                        <td>
                            <a href="/game?id=<?=$order->game_id;?>">
                                <?=$order->game->name_game;?>
                            </a>
                        </td>
                        <td><?=$order->created_at;?></td>
                        <td><?=date("Y-m-d", strtotime('+2 weeks', strtotime($order->created_at)));?></td>
                        <td style="width: 80px; text-align: center;">
                            <?php if ((date("Y-m-d")) <= date("Y-m-d", strtotime('+2 weeks', strtotime($order->created_at)))) : ?>
                                <form action="/store" method="POST">
                                    <input type="hidden" value="<?=$order->id?>" name="id">
                                    <button class="button is-small is-danger" type="submit">
                                        Вернуть
                                    </button>
                                </form>
                            <?php endif;?>
                        </td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php \Core\View::renderFooter(); ?>
