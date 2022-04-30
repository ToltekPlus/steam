<?php \Core\View::renderHeader(); ?>
    <section class="columns is-full is-centered is-vertical catalog-block">
        <div class="column is-8">
            <div class="columns is-multiline">
                <div class="column is-full">
                    <h1>Корзина</h1>
                </div>

                <div class="column is-two-thirds">
                    <div class="product-in-cart" id="basket"></div>
                </div>

                <div class="column">
                    <aside class="cart">
                        <div>
                            <h2>Информация о покупке</h2>
                        </div>
                        <div class="cart-information">
                            <div>
                                <h3>Количество</h3>
                                <h3>Итого</h3>
                            </div>
                            <div id="cart-data"></div>
                        </div>
                        <div class="to-pay">
                            <button>Оформить</button>
                        </div>
                    </aside>
                </div>
            </div>

            <div class="other-products">
                <h2>Будет интересно</h2>
                <div class="recommend-games">
                    <div class="columns is-multiline">
                        <div class="column is-one-quarter game">
                            <div class="game-cover">
                                <figure class='image is-full'>
                                    <a href="">
                                        <img src="images/cyber.jpg" alt="">
                                    </a>
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
                                <figure class='image is-full'>
                                    <a href="">
                                        <img src="images/fifa.jpg" alt="">
                                    </a>
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
                                    <a href="">
                                        <img src="images/witcher.jpg" alt="">
                                    </a>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php \Core\View::renderFooter(); ?>

