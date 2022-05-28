<?php \Core\View::renderHeader(); ?>

<section class="columns is-full is-centered is-vertical catalog-block">
    <div class="column is-8 ctr">
        <div class="columns is-multiline">
            <div class="column is-full product-title">
                <h1><?=$game->name_game;?></h1>
            </div>

            <div class="column is-two-thirds">
                <div class="product">
                    <div class="product-preview scale">
                        <img src="images/<?=$game->cover_game;?>" alt="<?=$game->name_game;?>" class="scale">
                    </div>

                    <div class="product-description">
                        <h2>Об игре</h2>
                        <div>
                            <?=$game->description_game;?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="column wer">
                <aside class="product-data wer">
                    <div class="product-logo">
                        <center>
                            <img src="images/<?=$game->logotype_company;?>" alt="<?=$game->name_game;?>" width="150px">
                        </center>
                    </div>

                    <div class="product-categories">
                        <ul class="column is-12 gnr">
                            <li>
                                <?=$game->name_genre;?>
                            </li>
                        </ul>
                    </div>

                    <div class="product-price">
                        <?=($tax->tax == 0) ? $game->base_price : ($game->base_price - ($game->base_price*($tax->tax/100))); ?> &#x20bd

                        <?php if ($tax->tax != 0): ?>
                            <span class="discount-price"><?=$game->base_price;?> &#x20bd</span><span class="discount"><?=$tax->tax;?> %</span>
                        <?php endif;?>
                    </div>

                    <div class="to-cart buy" id="<?=$game->id;?>">
                        <button>Добавить в корзину</button>
                    </div>

                    <div class="product-data-information">
                        <div class="data-info">
                            <div>
                                <h3>Разработчик</h3>
                                <?=$game->name_company;?>
                            </div>
                        </div>

                        <div class="data-info">
                            <div>
                                <h3>Дата добавления</h3>
                                <?=$game->created_at;?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php \Core\View::renderFooter(); ?>
