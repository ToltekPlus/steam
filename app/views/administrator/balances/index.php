<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
             <section style='display:flex; margin: 8% 0% 0% 13%;'>
                <? foreach($balances as $balance):?>
                <div style='display:block; margin: 0% 15% 0% 10%;'>
                      <h2>Баланс: </h2>
                      <h1><?=$balance->balance?>RUB</h1>
                </div>
                <div style="display: block;">
                    <div>
                        <a href="replenish" class="button is-success is-light">Пополнить</a>
                    </div>
                    <div style="margin-top: 10%;">
                        <a href="history" class="button is-success is-light">История пополнений</a>
                    </div>
                </div>
                <? endforeach;?>
            </section>
        </section>
    </section>
<?php \Core\View::renderFooter()?>
