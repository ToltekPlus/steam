<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
             <section style='display:flex; margin: 6% 0% 0% 13%;'>
                <? foreach($balances as $balance):?>
                <div style='display:block; margin: 2% 15% 0% 10%;'>
                      <h2>Баланс: </h2>
                      <h1><?=$balance->balance?>RUB</h1>
                </div>
                <div style="display:block">
                    <form action="show" method="POST" style="margin: 5% 0% 10% 0%;">
                        <div class="form-control">
                            <div class='buttons'>
                                <button class="button is-success is-light" type="submit">Пополнить</button>
                            </div>
                        </div>
                    </form>
                    <form action="history" method="POST">
                        <div class="form-control">
                            <div class='buttons'>
                                <button class="button is-success is-light" type="submit">История пополнений</button>
                            </div>
                        </div>
                    </form>
                </div>
                <? endforeach;?>
            </section>
        </section>
    </section>
<?php \Core\View::renderFooter()?>
