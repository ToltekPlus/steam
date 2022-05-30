<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Компании</h1>
            <ul>
                <li>
                    <a href="/companies/add">Добавить компанию</a>
                </li>
            </ul>
            <table class="table">
                <thead>
                    <tr>
                        <th>Компании</th>
                        <th>О компании</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($companies as $company) : ?>
                    <tr>
                        <td><?=$company->name_company;?></td>
                        <td><?=$company->description_company;?></td>
                        <td>
                            <a href="/companies/edit?id=<?=$company->id?>">
                                <ion-icon name="pencil-outline"></ion-icon>
                            </a>
                        </td>
                        <td style="width: 80px; text-align: center;">
                            <a href="visibility?id=<?=$company->id?>">
                                <?php echo $company->visibility == 1 ? "Скрыть" : "Показать";?>
                            </a>
                        </td>
                        <td style="width: 80px; text-align: center;">
                            <form action="/delete" method="POST">
                                <input type="hidden" value="<?=$company->id?>" name="id">
                                <button class="button is-small is-danger" type="submit">
                                    <ion-icon name="close-outline"></ion-icon>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>
