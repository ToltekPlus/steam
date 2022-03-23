<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <section style='display:flex; margin: 8% 0% 0% 13%;'>
                <? foreach($balances as $balance):?>
                <table class="table">
                    <tr>
                        <thead>
                            <th>Баланс</th>
                            <th>Сумма пополнения</th> 
                            <th>Время пополнения</th>
                        </thead>
                    </tr>
                    <tbody>
                    <?echo `<tr>
                        <td>$balance->balance</td>
                        <td>$balances->sum</td>
                        <td>$balances->created_at</td>
                           </tr>`?>
                    </tbody>
                    <?//чтото не робит бру?>
                </table>
                <? endforeach;?>
            </section>
        </section>
    </section>
<?php \Core\View::renderFooter()?>