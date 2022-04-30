<?php \Core\View::renderHeader(); ?>
<section class="columns is-full is-centered is-vertical catalog-block" xmlns="http://www.w3.org/1999/html"
         xmlns="http://www.w3.org/1999/html">
        <div class="column is-8">
            <div class="columns is-multiline">
                <div class="column is-full">
                    <h1>Мои игры</h1>
                    <table class="table">
                </div>
                <div>

                        <h3>Приобретёные</h3>
                        <?php foreach ($myGames as $game) :?>
                            <div>
                                <?=$game->name_game;?>
                            </div>
                            <form action="/delete" method="POST">
                                <input type="hidden" value="<?=$game->id?>" name="id">
                                <button class="button is-small is-danger" type="submit">
                                    refund
                                </button>
                            </form>
                            </td>
                            <?php foreach ($order as $order)
                                $oldDate   = '<?=$order->order_date?>';
                            $date1 = date("Y-m-d", strtotime($oldDate.'+ 14 days'));
                            echo '<h3>Можно вернуть до: ' . htmlspecialchars($date1) . '</h3>';

                            ?>

                            </table>
                        <?php endforeach;?>
                </div>

                <div class="column is-two-thirds">
                    <div class="product-in-cart" id="orders"></div>
                </div>

                <div class="column">
                    <aside class="cart">
                    </aside>
                </div>
            </div>

            <div class="recommend-games">
                <div class="columns is-multiline">
                    <div class="column is-one-quarter game">
                        <div class="game-cover">
                            <figure class='image is-full'>

                            </figure>
                        </div>
                    </div>
                </div>
            </div>

    </section>
<?php \Core\View::renderFooter(); ?>
