<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Добавить изображение для игры</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="store" enctype="multipart/form-data">
                        <input type="hidden" name="game_id" id="game_id" value="<?=$game_id?>">

                        <div class="form-control">
                            <div class="file is-info is-small has-name"  id="file-js-example">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="image" id="file">
                                    <span class="file-cta">
                                              <span class="file-icon">
                                                <i class="fas fa-upload"></i>
                                              </span>
                                              <span class="file-label">
                                                Выбрать изображение
                                              </span>
                                            </span>
                                    <span class="file-name">
                                              Изображение
                                            </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-control">
                            <div class="buttons">
                                <button class="button is-success is-light" type="submit">Добавить</button>
                            </div>
                        </div>
                    </form>

                    <div style="margin-top: 35px;">
                        <h2>Другие изображения</h2>
                        <?php foreach ($images as $image) :?>
                            <img src="../images/administrator/<?=$image->path;?>" alt="Изображение">
                            <a href="delete?id=<?=$image->id?>">Удалить</a> <br><br>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </section>
    </section>
<?php \Core\View::renderFooter();?>
