<?php \Core\View::renderHeader(); ?>
    <section class="columns is-full is-centered is-vertical catalog">
        <section class="column is-8 filter">
            <div class="logs">
                <div class="logs-description">
                    <h2>Логи</h2>
                    <div>
                        <?php
                        //while (($line = fgets($logs)) !== false) {
                        foreach ($logs as $line) {
                            $parser = explode('[', $line);

                            $type = mb_substr($parser[1], 0, -1);
                            $date = mb_substr($parser[2], 0, -2);

                            $lenght_type = strlen($type) + 2;
                            $lenght_date = strlen($date) + 2;

                            $dt = mb_eregi_replace("^.{" . $lenght_date . "}(.*)$", '\\1', $line);
                            $text = mb_eregi_replace("^.{" . $lenght_type . "}(.*)$", '\\1', $dt);
                        ?>
                            <div class="log-param">
                                <span class="log-type"><?=$type;?></span>
                                <span class="log-date"><?=$date;?></span>
                            </div>
                            <div class="log-text">
                                <?=$text;?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>


        </section>
    </section>

<?php \Core\View::renderFooter(); ?>