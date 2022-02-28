<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <? foreach($balances as $balance):?>
            <div>Баланс: <?$balance->balance?></div>
            <? endforeach;?>
            <form action="store" method="POST">
                <input type="text" name="sum" id="sum">
                <input type="button" name="add" id="add" value="Пополнить">
            </form>
        </section>
    </section>
<?php \Core\View::renderFooter()?>
