<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="columns is-multiline">
                <div class="column is-full form-title">
                    <h1>Смена пароля пользователю</h1>
                </div>

                <div class="column is-two-thirds form">
                    <form method="POST" action="update_password" enctype="multipart/form-data">
                        <div class="form-control">
                            <p>Сгенерированный пароль:</p>
                            <p><?=$user->password?></p>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
<?php \Core\View::renderFooter();?>