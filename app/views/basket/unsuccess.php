<?php \Core\View::renderHeader(); ?>

<div class="payment" data-status="<?=$status?>">
    <h1>На счёте не достаточно средств для покупки.<h1>
    <h2>Пожалйста, пополните счёт.<h2>
    <a href="/">На главную</a>
</div>

<?php \Core\View::renderFooter(); ?>
