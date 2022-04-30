<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Редактирование жанра</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="update" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?=$genre->id?>">
                        <div class="form-control">
                            <label for="name_genre">Название жанра</label>
                            <input type="text" name="name_genre" id="name_genre" placeholder="Введите жанр" autocomplete="off" value="<?=$genre->name_genre?>">
                        </div>

                        <div class="form-control">
                            <div class="file is-info is-small has-name"  id="file-js-example">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="icon" value="<?=$genre->icon_genre?>">
                                    <span class="file-cta">
                                              <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                              </span>
                                              <span class="file-label">
                                                Выбрать файл
                                              </span>
                                            </span>
                                    <span class="file-name">
                                              <?=$genre->icon_genre?>
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