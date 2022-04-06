<? Core\View::renderHeader();?>
<?//TODO: перенести все style в sass?>
	<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
        	<section style='display:flex; margin: auto 0'>
        	<? foreach($expenses as $expense):?>
	        	<div style='display:block; margin-top: 4%'>
	        		<a href="list">Назад на главную</a>
	                <h2>Баланс: </h2>
	                <h1><?=$expense->balance?> RUB</h1>
	            </div>
	        	<form action="confirm" method="POST" id="sum" class="form" style="margin-left: 12%; width: 70%;">
		        	<div class="form-control">
		                    <input type="hidden" value="<?=$expense->id?>" name="id">
		                    <input type="hidden" value="<?=1?>" name="type_operation_id">
		                    <input type="text" name="sum" id="sum">
		                <div style="margin-left: 42%" class="buttons">
		                    <button class="button is-success is-light" type="submit">Пополнить</button>
		                </div>
		            </div>
		        </form>
	        <?endforeach;?>
	    	</section>
        </section>
    </section>
<? Core\View::renderFooter();?>