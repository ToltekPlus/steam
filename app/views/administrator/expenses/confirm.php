<?php \Core\View::renderHeader()?>
<?php //TODO: перенести все style в sass?>
 <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
        	<div style="text-align: center;"><h2>Вы уверены, что хотите пополнить баланс на сумму</h2>
        	<h1><?=$balance;?>RUB?</h1></div>
        	<div style='display: flex; margin: 5% 0% 0% 39%;'>
        	<form action="replenish" method="POST" id='confirm' style='margin-right: 10%;'>
                     <input type="hidden" name="balance" value="<?=$_POST['balance']?>">
                     <input type="hidden" name="id" value="<?=$_POST['id']?>">
                     <input type="hidden" name="type_operation_id" value="<?=$_POST['type_operation_id']?>">
        		<button class="button is-success is-light">Да</button>
        	</form>
        	<form action="list" id='confirm'>
        		<button class="button is-success is-light">Нет</button>
        	</form>
        </section>
 </section>
<?php \Core\View::renderFooter()?>
