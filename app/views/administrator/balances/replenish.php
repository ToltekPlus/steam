<? Core\View::renderHeader();?>
	<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
        	<section style='display:flex; margin: 6% 0% 0% 10%;'>
        	<? foreach($balances as $balance):?>
	        	<div style='display:block; margin: 7% 15% 0% 0%;'>
	                <h2>Баланс: </h2>
	                <h1><?=$balance->balance?>RUB</h1>
	            </div>
	        	<form action="replenish" method="POST" name="sum" id="sum" class="form" style="width: 70%;">
		        	<div class="form-control">
		                    <input type="hidden" value="<?=$balance->id?>" name="id">
		                    <input type="text" name="sum" id="sum">
		                <div style="margin-left: 36%" class="buttons">
		                    <button class="button is-success is-light" type="submit">Пополнить</button>
		                </div>
		            </div>
		        </form>
	        <?endforeach;?>
	    	</section>
        </section>
    </section>
<? Core\View::renderFooter();?>