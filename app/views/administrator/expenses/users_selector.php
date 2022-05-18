<form style="position: absolute; margin-left: 12%;" action="main" method="POST" id="user">
    <div>
        <h4>Пользователь: <?php echo $account['name'] . " " . $account['surname'];?></h4>
    </div>
    <div style="display:flex; margin-top: 8%;">
        <div class="select is-rounded is-small">
            <select name="user">
                <?php foreach ($users as $user):?>
                <option value="<?=$user['id'];?>" name="user">
                    <?=$user['full_name']?>
                </option>
                <?php endforeach;?>
            </select>
        </div>
        <div class="buttons" style="margin-left: 5%;">
            <button class="button is-success is-light" type="submit">Выбрать</button>
        </div>
    </div>
</form>
