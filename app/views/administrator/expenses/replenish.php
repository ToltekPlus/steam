<? Core\View::renderHeader();?>
<?//TODO: перенести все style в sass?>
	<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
        	<section style='display:flex; margin: auto 0'>
        	<? foreach($expenses as $expense):?>
	        	<div style='display:block; margin-top: 6%'>
	                <h2>Баланс: </h2>
	                <h1><?=$expense->balance?>RUB</h1>
	            </div>
	        	<form action="confirm" method="POST" id="sum" class="form" style="margin-left: 15%; width: 70%;">
		        	<div class="form-control">
		                    <input type="hidden" value="<?=$expense->id?>" name="id">
		                    <input type="hidden" value="<?=1?>" name="type_operation_id">
		                    <input type="text" name="sum" id="sum">
		                <div style="margin-left: 38%" class="buttons">
		                    <button class="button is-success is-light" type="submit">Пополнить</button>
		                </div>
		            </div>
		        </form>
	        <?endforeach;?>
	    	</section>
        </section>
    </section>
<? Core\View::renderFooter();?>