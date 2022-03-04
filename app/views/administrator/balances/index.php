<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <? foreach($balances as $balance):?>
            <h2>Баланс: <?=$balance->balance?>RUB</h2>
            <? endforeach;?>
            <form action="store" method="POST" class="form">
                <div class="form-control">
                        <input type="text" name="sum" id="sum">
                    <div class="buttons">
                        <button class="button is-success is-light" type="submit">Пополнить</button>
                    </div>
                </div>
            </form>
        </section>
    </section>
<?php \Core\View::renderFooter()?>
