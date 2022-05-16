<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <?php 
            if($role == 3){
                \Core\View::render('administrator/expenses/users_selector.php', ['users' => $users, 'account' => $account]);
            }?>
            <section style='display:flex; <?=($role == 3)? "margin: 13% 19% 0% 19%": "margin: 0% 19% 0% 19%"?>'>
                <?php foreach($expenses as $expense):?>
                <div style='margin-right: 25%;'>
                      <h2>Баланс: </h2>
                      <h1><?=$expense->balance?> RUB</h1>
                </div>
                <div>
                    <form method="POST" action="show">
                        <div>
                            <input type="hidden" value="<?=$expense->user_id?>" name="user">
                            <button class="button is-success is-light">Пополнить</button>
                        </div>
                    </form>
                    <form method="POST" action="history" style="margin-top: 10%">
                        <div>
                            <input type="hidden" value="<?=$expense->user_id?>" name="user">
                            <button class="button is-success is-light">История пополнений</button>
                        </div>
                    </form>
                </div>
                <?php endforeach;?>
            </section>
        </section>
</section>
<?php \Core\View::renderFooter()?>
