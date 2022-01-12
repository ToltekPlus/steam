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
                            <ion-icon name="logo-steam"></ion-icon>
                          </span>
                        <span class="steam">
                            Steam
                        </span>
                        </span>
            </div>

            <div class="column is-6">
                <nav>
                    <ul class="menu-list">
                        <li>
                            <a href="">Магазин</a>
                        </li>
                        <li>Новости</li>
                        <li>Поддержка</li>
                        <li>Сообщество</li>
                        <li>
                            <a href="/auth">
                                Псевдоаккаунт <?=$_SESSION['sid']?>
                            </a>
                        </li>
                        <li>
                            <a href="/logout">
                                Выйти
                            </a>
                        </li>
                        <?php if ($_SESSION['sid']):?>
                        <li>
                            <a href="/roles">
                                Роли
                            </a>
                        </li>
                        <?php endif;?>
                    </ul>
                </nav>
            </div>

            <div class="column is-3">
                        <span class="icon-text">
                          <span class="icon">
                            <ion-icon name="search-outline"></ion-icon>
                          </span>
                        </span>

                <span class="icon-text">
                          <span class="icon">
                            <ion-icon name="heart-outline"></ion-icon>
                          </span>
                        </span>

                <span class="icon-text">
                          <span class="icon">
                            <ion-icon name="basket-outline"></ion-icon>
                          </span>
                        </span>

                <span class="login">
                    <button class="button is-small" id="enterToAccount">Войти</button>
                </span>
            </div>
        </div>
    </div>
</header>