<?php Core\View::renderHeader();?>
	<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
			<section style='display:flex; margin: auto 0'>
				<?php foreach($expenses as $expense):?>
	        	<div style='display:block; margin-top: 4%'>
            		<a href="main?id=<?=$_POST['user'];?>">Назад на главную</a>
	                <h2>Баланс: </h2>
	                <h1><?=$expense->balance?> RUB</h1>
	            </div>
	        	<form action="confirm" method="POST" id="sum" class="form" style="margin-left: 12%; width: 70%">
		        	<div class="form-control">
		                <input type="hidden" value="<?=$expense->id?>" name="id">
		                <input type="hidden" value="<?=$expense->user_id?>" name="user">
		                <input type="text" name="balance" id="balance">
				        <div style="display: flex; justify-content: center;" class="buttons">
				            <button class="button is-success is-light" type="submit">Пополнить</button>
				        </div>
		            </div>
		        </form>
	        	<?php endforeach;?>
	    	</section>
        </section>
    </section>
<?php Core\View::renderFooter();?>
