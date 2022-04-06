<?php \Core\View::renderHeader()?>
<?//TODO: перенести все style в sass?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
             <section style='display:flex; margin: 6% 19%;'>
                <? foreach($expenses as $expense):?>
                <div style='margin-right: 25%;'>
                      <h2>Баланс: </h2>
                      <h1><?=$expense->balance?> RUB</h1>
                </div>
                <div>
                    <div>
                        <a href="show" class="button is-success is-light">Пополнить</a>
                    </div>
                    <div style="margin-top: 10%;">
                        <a href="history" class="button is-success is-light">История пополнений</a>
                    </div>
                </div>
                <?endforeach;?>
            </section>
        </section>
</section>
<?php \Core\View::renderFooter()?>
