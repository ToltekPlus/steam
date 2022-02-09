<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Компании</h1>
            <ul>
                <li>
                    <a href="/companies/add">Добавить компанию</a>
                </li>
            </ul>
            <table>
                <tr>
                    <th>Компании</th>
                    <th>О компании</th>
                    <th></th>
                </tr>

                <?php foreach ($companies as $company) : ?>
                <tr>
                    <td><?=$company->name_company;?></td>
                    <td><?=$company->description_company;?></td>
                    <td>
                        <a href="/companies/edit?id=<?=$company->id?>">Редактировать</a>
                    </td>
                    <td style="width: 80px; text-align: center;">
                        <a href="/companies/delete?id=<?=$company->id?>">X</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>