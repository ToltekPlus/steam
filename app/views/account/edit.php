<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Ваш профиль</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="update" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?=$account->id?>">
                        <div class="form-control">
                            <label for="name">Ваше имя</label>
                            <input type="text" name="name" id="name" placeholder="Введите имя" autocomplete="off" value="<?=$account->name?>">
                        </div>

                        <div class="form-control">
                            <label for="surname">Ваша фамилия</label>
                            <input type="text" name="surname" id="surname" placeholder="Введите фамилию" autocomplete="off" value="<?=$account->surname?>">
                        </div>

                        <div class="form-control">
                            <label for="about">Описание профиля</label>
                            <textarea type="text" name="about" id="about" placeholder="Описание профиля"><?=$account->about?></textarea>
                        </div>

                        <div class="form-control">
                            <label for="birthday_at">Дата рождения: </label>
                            <input type="date" name="birthday_at" id="birthday_at" placeholder="Дата рождения" value="<?=$account->birthday_at?>">
                        </div>

                        <p>Фото профиля:</p>

                        <div class="form-control">
                            <div class="file is-info is-small has-name"  id="file-js-example">
                                <label class="file-label">
                                    <input class="file-input" type="file" name="userpic" value="<?=$account->userpic?>">
                                    <span class="file-cta">
                                              <span class="file-logotype">
                                                <i class="fas fa-upload"></i>
                                              </span>
                                              <span class="file-label">
                                                Изменить фото
                                              </span>
                                            </span>
                                    <span class="file-name">
                                              <?=$account->userpic?>
                                            </span>
                                </label>
                            </div>
                        </div>

                        <div class="form-control">
                            <button type="button" class="button is-small is-danger" id="deleteUserpic">Удалить фото</button>
                        </div>

                        <div class="form-control">
                            <div class="buttons">
                                <button class="button is-success is-light">Обновить информацию</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
<?php \Core\View::renderFooter();?>