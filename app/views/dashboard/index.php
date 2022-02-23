<?php \Core\View::renderHeader(); ?>

<section class="columns is-full is-centered is-vertical catalog">
    <section class="column is-8 filter">
        <div class="select is-rounded is-small">
            <select>
                <option>Жанры</option>
                <?php foreach ($genres as $genre): ?>
                    <option value="<?=$genre->id; ?>" name="<?=$genre->name_genre; ?>">
                        <?=$genre->name_genre; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="select is-rounded is-small">
            <select>
                <option>Компании</option>
                <?php foreach ($companies as $company): ?>
                    <option value="<?=$company->id; ?>" name="<?=$company->name_company; ?>">
                        <?=$company->name_company; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <section class="catalog-sort-visible">
            <nav class="columns">
                <ul class="column is-12">
                    <li class="sort-visible">
                        Однопользовательская игра
                        <span>&#x2715</span>
                    </li>
                    <li class="sort-visible">
                        Многопользовательская игра
                        <span>&#x2715</span>
                    </li>
                    <li class="sort-visible">
                        ММОРПГ
                        <span>&#x2715</span>
                    </li>
                    <li>
                        <a href="">
                            Очистить все
                        </a>
                    </li>
                </ul>
            </nav>
        </section>
    </section>
</section>

<section class="columns is-full is-centered is-vertical catalog-block">
    <div class="column is-8">
        <div class="columns is-multiline">
            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <div class="buy" id="0">
                                <span class="icon">
                                    <ion-icon name="cart-outline"></ion-icon>
                                </span>
                        Добавить в корзину
                    </div>
                    <figure class='image is-full'>
                        <img src="images/cyber.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        Cyberpunk 2077
                    </div>
                    <div class="game-company">
                        CD Project Red
                    </div>
                    <div class="game-price">
                        3499 &#x20bd
                        <span class="discount">-20%</span>
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <div class="buy" id="game-1">
                                <span class="icon">
                                    <ion-icon name="cart-outline"></ion-icon>
                                </span>
                        Добавить в корзину
                    </div>

                    <figure class='image is-full'>
                        <img src="images/fifa.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        FIFA 21
                    </div>
                    <div class="game-company">
                        EA Games
                    </div>
                    <div class="game-price">
                        4555 &#x20bd
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/witcher.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        The Witcher 3
                    </div>
                    <div class="game-company">
                        CD Project Red
                    </div>
                    <div class="game-price">
                        1499 &#x20bd
                        <span class="discount">-60%</span>
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/last.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        The last of us. Part 2
                    </div>
                    <div class="game-company">
                        Naughty Dog
                    </div>
                    <div class="game-price">
                        4499 &#x20bd
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/forza.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        The last of us. Part 2
                    </div>
                    <div class="game-company">
                        Naughty Dog
                    </div>
                    <div class="game-price">
                        4499 &#x20bd
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/rdr2.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        Red Dead Redemption 2
                    </div>
                    <div class="game-company">
                        Rockstar Games
                    </div>
                    <div class="game-price">
                        4299 &#x20bd
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/str.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        Death Stranding
                    </div>
                    <div class="game-company">
                        GENIUS
                    </div>
                    <div class="game-price">
                        3899 &#x20bd
                        <span class="discount">-60%</span>
                    </div>
                </div>
            </div>

            <div class="column is-one-quarter game">
                <div class="game-cover">
                    <figure class='image is-full'>
                        <img src="images/apex.jpg" alt="">
                    </figure>
                </div>
                <div class="game-description">
                    <div class="game-title">
                        Apex Legends
                    </div>
                    <div class="game-company">
                        Respawn
                    </div>
                    <div class="game-price">
                        Free
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php \Core\View::renderFooter(); ?>