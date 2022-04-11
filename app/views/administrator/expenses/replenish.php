<? Core\View::renderHeader();?>
<?//TODO: перенести все style в sass?>
	<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
        		<form style="position: absolute;" action="show" method="POST" id="user">
			        <h4>Пользователь: </h4>
			        <div style="display:flex;">
					    <div class="select is-rounded is-small">
						    <select name="user">
						    	<?foreach ($users as $user):?>
				                <option value="<?=$user;?>" name="user">
				                    <?=$user?>
				                </option>
				                <?endforeach;?>
				            </select>
				        </div>
				        <div class="buttons" style="margin-left: 5%;">
					        <button class="button is-success is-light" type="submit">Выбрать</button>
					    </div>
					</div>
			    </form>
			<section style='display:flex; margin: auto 0; margin-top: 10%;'>
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
		                <input type="hidden" value="<?=$expense->user_id?>" name="user_id">
		                <input type="text" name="sum" id="sum">
				        <div style="display: flex; justify-content: center;" class="buttons">
				            <button class="button is-success is-light" type="submit">Пополнить</button>
				        </div>
		            </div>
		        </form>
	        	<?endforeach;?>
	    	</section>
        </section>
    </section>
<? Core\View::renderFooter();?>