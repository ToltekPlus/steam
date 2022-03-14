<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Редактирование игры</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="update" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?=$game->id?>">
                        <div class="form-control">
                            <label for="name_genre">Название игры</label>
                            <input type="text" name="name_game" id="name_game" placeholder="Название игры" autocomplete="off" value="<?=$game->name_game?>">
                        </div>

                        <div class="select is-rounded is-small">
                            <select name="genre_id">
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?=$genre->id; ?>" name="<?=$genre->name_genre; ?>"
                                        <?php if ($game->genre_id == $genre->id) : ?> selected="selected" <?php endif;?>>
                                        <?=$genre->name_genre; ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="select is-rounded is-small">
                            <select name="company_id">
                                <option>Выберите компанию</option>
                                <?php foreach ($companies as $company): ?>
                                    <option value="<?=$company->id; ?>" name="<?=$company->name_company; ?>"
                                        <?php if ($game->company_id == $company->id) : ?> selected="selected" <?php endif;?>>
                                        <?=$company->name_company; ?>
                                    </option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="form-control">
                            <label for="description_company">Описание игры</label>
                            <textarea type="text" name="description_game" id="description_game" placeholder="Об игре"><?=$game->description_game?></textarea>
                        </div>

                        <div class="form-control">
                            <label for="name_genre">Базовая стоимость</label>
                            <input type="number" name="base_price" id="base_price" placeholder="Цена" autocomplete="off" value="<?=$game->base_price?>">
                        </div>

                        <div class="form-control">
                            <div class="file is-info is-small has-name"  id="file-js-example">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="cover_game" value="<?=$game->cover_game?>">
                                    <span class="file-cta">
                                              <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                              </span>
                                              <span class="file-label">
                                                Выбрать файл
                                              </span>
                                            </span>
                                    <span class="file-name">
                                        <?=$game->cover_game?>
                                    </span>
                                </label>
                            </div>
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