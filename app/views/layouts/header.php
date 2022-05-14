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
                <span class="icon-text">
                    <span class="icon logotype">
                      <a href="/">
                          <ion-icon name="logo-steam"></ion-icon>
                      </a>
                    </span>
                    <span class="steam">
                <nav>
                    <ul class="menu-list">
                        <li>
                            <a href="">Магазин</a>
                        </li>
                        <li>Новости</li>
                        <li>Поддержка</li>
            <div class="column is-3">
                <span class="icon-text">
                  <span class="icon">
                    <ion-icon name="search-outline"></ion-icon>
                  </span>
                </span>

                    </div>
                </div>


                <?php if (isset($_SESSION['sid'])):?>
                <span class="login">
                    <div class="dropdown">
                      <div class="dropdown-trigger userpic">
                          <img src="../images/<?=\App\Controller\HomeController::accountUserpic();?>" alt="Юзерпик" >
                      </div>
                      <div class="dropdown-menu" id="dropdown-ui-actions" role="menu">
                        <div class="dropdown-content">
                        <?php switch (\App\Controller\HomeController::accountRole()): ?><?php case 1: ?>
                             <a href="/expenses/list" class="dropdown-item">
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
                            <a href="/expenses/list" class="dropdown-item">Пополнение счета пользователю</a>
                             <a href="/expenses/list" class="dropdown-item">
                                Кошелек
                            </a>
                             <a href="/logout" class="dropdown-item">
                                Выход
                            </a>
                        <?php break; case 3: ?>
                            <a href="/expenses/list" class="dropdown-item">
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
</header>
