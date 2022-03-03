<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Обновление скидки для игры</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="/update" enctype="multipart/form-data">
                        <input type="hidden" name="game_id" id="game_id" value="<?=$game->game_id?>">
                        <input type="hidden" name="id" id="id" value="<?=$game->id?>">
                        <div class="select is-rounded is-small">
                            <select name="tax" id="tax">
                                <?php for($i = 0; $i < 90; $i= $i + 10) : ?>

                                    <option  name="tax"
                                        <?php if ($game->tax == $i) : ?> selected="selected" <?php endif;?>>
                                        <?=$i;?>
                                    </option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label for="end_of_discount">Дата окончания действия скидки</label>
                            <input type="date" name="end_of_discount" id="end_of_discount" placeholder="Выберите дату" autocomplete="off" value="<?=$game->end_of_discount;?>">
                        </div>

                        <div class="form-control">
                            <div class="buttons">
                                <button class="button is-success is-light" type="submit">Обновить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
<?php \Core\View::renderFooter();?>