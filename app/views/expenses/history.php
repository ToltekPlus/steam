<?php \Core\View::renderHeader();?>
<section class="columns is-full is-centered is-vertical catalog">
    <section class="column is-8 filter">
        <h1>История пополнений</h1>
        <div>
            <a href="main?id=<?=$_POST['user'];?>">Назад на главную</a>
        </div>
        <table class="table">
            <tr>
                <thead>
                    <th>№</th>
                    <th>Сумма</th>
                    <th>Тип операции</th>
                    <th>Статус</th>
                    <th>Время операции</th>
                    <th>Кошелёк</th>
                </thead>
            </tr>
            <tbody>
            <?php
            $num = 0;
            foreach($histories as $history):
                $num += 1;
                    if($role == 1){
                        foreach($expenses as $expense):
                        if($history->expense_id == $expense->id){
                            if($expense->user_id == $_SESSION['sid']){
                                echo '<tr>' .
                                '<td>' . $num  . '</td>' .
                                '<td>' . $history->balance . '</td>' .
                                '<td>' . $history->type_operation_id . '</td>' .
                                '<td>' . $history->status . '</td>' .
                                '<td>' . $history->date_of_enrollment . '</td>' .
                                '<td>' . $history->expense_id . '</td>' .
                                '</tr>';
                            }
                        }
                        endforeach;
                    } else {
                        echo '<tr>' .
                        '<td>' . $num  . '</td>' .
                        '<td>' . $history->balance . '</td>' .
                        '<td>' . $history->type_operation_id . '</td>' .
                        '<td>' . $history->status . '</td>' .
                        '<td>' . $history->date_of_enrollment . '</td>' .
                        '<td>' . $history->expense_id . '</td>' .
                        '</tr>'; 
                    }
            endforeach;
             ?>
            </tbody>
        </table>
    </section>
</section>
<?php \Core\View::renderFooter()?>
