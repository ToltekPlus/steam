<?php \Core\View::renderHeader()?>
<section class="columns is-full is-centered is-vertical catalog">
    <section class="column is-8 filter">
        <h1>История пополнений</h1>        
        <div>
            <a href="list">Назад на главную</a>
        </div>
        <table class="table">
            <tr>
                <thead>
                    <th>Баланс</th>
                    <th>Сумма</th> 
                    <th>Тип операции</th>
                    <th>Статус</th>
                    <th>Время операции</th>
                </thead>
            </tr>
            <tbody>
            <? foreach($expenses as $expense):
            switch ($expense->status) {
                case '1':
                    $expense->status = 'Выполнено';
                    break;
                case '0':
                    $expense->status = 'Невыполнено';
                    break;
            }
                echo '<tr>' . 
            '<td>' . $expense->sum . '</td>' . 
            '<td>' . $expense->balance . '</td>' . 
            '<td>' . $expense->type . '</td>' .
            '<td>' . $expense->status . '</td>' .
            '<td>' . $expense->date_of_enrollment . '</td>' . 
                '</tr>'?>
            <? endforeach;?>
            </tbody>
        </table>
    </section>
</section>
<?php \Core\View::renderFooter()?> 
