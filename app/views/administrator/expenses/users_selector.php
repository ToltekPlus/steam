<form style="position: absolute; margin-left: 12%;" action="main" method="POST" id="user">
    <div style="position:absolute; margin-left: 105%;">
        <h4><? echo $account[0]?></h4>
        <h4><? echo $account[1]?></h4>
    </div>
    <h4>Пользователь: </h4>                   
    <div style="display:flex; margin-top: 8%;">
        <div class="select is-rounded is-small">
            <select name="user">
                <?php foreach ($users as $user):?>
                <option value="<?=$user;?>" name="user">
                    <?=$user?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="buttons" style="margin-left: 5%;">
            <button class="button is-success is-light" type="submit">Выбрать</button>
        </div>
    </div>
</form>