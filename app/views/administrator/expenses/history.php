<?php \Core\View::renderHeader();?>
<section class="columns is-full is-centered is-vertical catalog">
    <section class="column is-8 filter">
        <h1>История пополнений</h1>        
        <div>
            <a href="list">Назад на главную</a>
        </div>
        <table class="table">
            <tr>
                <thead>
                    <th>№</th>
                    <?//<th>Баланс</th>?>
                    <th>Сумма</th> 
                    <th>Тип операции</th>
                    <th>Статус</th>
                    <th>Время операции</th>
                </thead>
            </tr>
            <tbody>
            <?  
                $num = 0;
            foreach($expenses as $expense):
                $num += 1; 
                    echo '<tr>' . 
                '<td>' . $num  . '</td>' .
                //'<td>' . $expense->expense_id . '</td>' . 
                '<td>' . $expense->sum . '</td>' . 
                '<td>' . $expense->type_operation_id . '</td>' .
                '<td>' . $expense->status . '</td>' .
                '<td>' . $expense->date_of_enrollment . '</td>' . 
                    '</tr>';
            endforeach;
             ?>
            </tbody>
        </table>
    </section>
</section>
<?php \Core\View::renderFooter()?> 
