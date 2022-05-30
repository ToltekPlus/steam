<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Магазин игр Steam</title>
    <link rel='stylesheet' href='/styles/style.css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.9/dist/sweetalert2.all.min.js"></script>
</head>
<body>
<header class="columns is-full is-centered is-vertical">
    <div class="column is-8">
        <div class="columns">
            <div class="column is-3">
                <span class="icon-text">
                    <span class="icon logotype">
                      <a href="/">
                          <ion-icon name="logo-steam"></ion-icon>
                      </a>
                    </span>
                    <span class="steam">
                        Steam
                    </span>
                </span>
            </div>

            <div class="column is-6 nav-navigation">
                <nav id="navigation">
                    <ul class="menu-list">
                        <li>
                            <a href="/">Магазин</a>
                        </li>
                        <li>
                            <a href="">Новости</a>
                        </li>
                        <li>
                            <a href="">Поддержка</a>
                        </li>
                        <li>
                            <a href="">Сообщество</a>
                        </li>
                    </ul>
                </nav>

                <div class="column is-12 search is-hidden">
                    <input type="text" id="searchBlock" class="search-block">

                    <div class="search-field" id="searchField"></div>
                </div>
            </div>

            <div class="left-items">
                <span class="icon-text">
                  <span class="icon" id="search">
                    <ion-icon name="search-outline"></ion-icon>
                  </span>
                </span>

                <div class="dropdown">
                    <div class="dropdown-trigger">
               <span class="icon-text">
                      <span class="icon" id="briefCart">
                        <ion-icon name="basket-outline"></ion-icon>
                      </span>
                </span>
                    </div>
                    <div class="dropdown-menu" id="dropdown-menu3" role="menu">
                        <div class="dropdown-content" id="cartContent">
                            <center>
                                <h4>Корзина</h4>
                            </center>
                        </div>
                    </div>
                </div>

                <?php if (isset($_SESSION['sid'])):?>
                <span class="login">
                    <div class="dropdown">
                      <div class="dropdown-trigger userpic">
                          <img src="../images<?=\App\Controller\HomeController::accountUserpic();?>" alt="Юзерпик" >
                      </div>
                      <div class="dropdown-menu" id="dropdown-ui-actions" role="menu">
                        <div class="dropdown-content">
                        <?php switch (\App\Controller\HomeController::accountRole()): ?><?php case 1: ?>
                            <a href="/account/edit" class="dropdown-item">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/expenses/main" class="dropdown-item">
                                Кошелек
                            </a>
                            <a href="#" class="dropdown-item">
                                Мои игры
                            </a>
                            <a href="#" class="dropdown-item">
                                Архив
                            </a>
                            <a href="/logout" class="dropdown-item">
                                Выход
                            </a>
                        <?php break; case 2: ?>
                            <a href="/account/edit" class="dropdown-item">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/logout" class="dropdown-item">
                                Выход
                            </a>
                        <?php break; case 3: ?>
                            <a href="/account/edit" class="dropdown-item">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/expenses/main" class="dropdown-item">
                                Кошелек
                            </a>
                            <a href="#" class="dropdown-item">
                                Мои игры
                            </a>
                            <a href="#" class="dropdown-item">
                                Архив
                            </a>
                            <a href="/roles/list" class="dropdown-item">
                                Пользователи
                            </a>
                            <a href="/games/list" class="dropdown-item">
                                Игры
                            </a>
                            <a href="/companies/list" class="dropdown-item">
                                Компании
                            </a>
                            <a href="/genres/list" class="dropdown-item">
                                Жанры
                            </a>
                            <a href="/symlinks" class="dropdown-item">
                                Сгенерировать псевдосылки
                            </a>
                            <a href="/logs" class="dropdown-item">
                                Логи
                            </a>
                            <a href="/logout" class="dropdown-item">
                                Выход
                            </a>
                        <?php endswitch; ?>
                        </div>
                      </div>
                    </div>
                </span>
                <?php else:?>
                <span class="login">
                    <button class="button is-small" id="enterToAccount">Войти</button>
                </span>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="hamburger-menu">
  <input id="menu__toggle" type="checkbox" />
  <label class="menu__btn" for="menu__toggle">
    <span></span>
  </label>
  <ul class="menu__box">
    <li><a class="menu__item" href="/">Магазин</a></li>
    <li><a class="menu__item" href="#">Новости</a></li>
    <li><a class="menu__item" href="#">Поддержка</a></li>
    <li><a class="menu__item" href="#">Сообщество</a></li>
<hr>
    <?php if (isset($_SESSION['sid'])):?>
                        <?php switch (\App\Controller\HomeController::accountRole()): ?><?php case 1: ?>
                            <a href="/account/edit" class="menu__item_adm">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/expenses/main" class="menu__item_adm">
                                Кошелек
                            </a>
                            <a href="#" class="menu__item_adm">
                                Мои игры
                            </a>
                            <a href="#" class="menu__item_adm">
                                Архив
                            </a>
                            <a href="/logout" class="menu__item_adm">
                                Выход
                            </a>
                        <?php break; case 2: ?>
                            <a href="/account/edit" class="menu__item_adm">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/logout" class="menu__item_adm">
                                Выход
                            </a>
                        <?php break; case 3: ?>
                            <a href="/account/edit" class="menu__item_adm">
                                <strong><?php (\App\Controller\HomeController::accountData()) ?></strong>
                            </a>
                            <a href="/expenses/main" class="menu__item_adm">
                                Кошелек
                            </a>
                            <a href="#" class="menu__item_adm">
                                Мои игры
                            </a>
                            <a href="#" class="menu__item_adm">
                                Архив
                            </a>
                            <a href="/roles/list" class="menu__item_adm">
                                Пользователи
                            </a>
                            <a href="/games/list" class="menu__item_adm">
                                Игры
                            </a>
                            <a href="/companies/list" class="menu__item_adm">
                                Компании
                            </a>
                            <a href="/genres/list" class="menu__item_adm">
                                Жанры
                            </a>
                            <a href="/symlinks" class="menu__item_adm">
                                Сгенерировать псевдосылки
                            </a>
                            <a href="/logs" class="menu__item_adm">
                                Логи
                            </a>
                            <a href="/logout" class="menu__item_adm">
                                Выход
                            </a>

                        <?php endswitch; ?>
                        <hr class="foter__item">
                <li class="phone__footer"><a class="foter__item" href="#">Что такое  Steam</a></li>
                <li class="phone__footer"><a class="foter__item" href="#">Пресс-релизы</a></li>
                        </div>
                      </div>
                    </div>

                </span>
                <?php else:?>
                <span class="login">
                    <button class="button is-small" id="enterToAccount">Войти</button>
                </span>
                <?php endif;?>
  </ul>
</div>
</header>
