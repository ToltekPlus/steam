<?php \Core\View::renderHeader();?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <h1>Компании</h1>
            <table>
                <tr>
                    <th>Компании</th>
                </tr>

                <?php foreach ($companies as $company) : ?>
                <tr>
                    <td><?=$company->name_company;?></td>
                </tr>
                <?php endforeach;?>
            </table>
        </section>
    </section>
<?php \Core\View::renderFooter();?>