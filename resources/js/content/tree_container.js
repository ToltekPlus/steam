export function tree_container(response, dashboard) {
    const result = JSON.parse(response);
    // удаляем все дочерние элементы с играми
    while (dashboard.firstChild) {
        dashboard.firstChild.remove();
    }

    for (const element of result) {
        const tree = document.createElement('div');
        tree.classList.add('column');
        tree.classList.add('is-one-quarter');
        tree.classList.add('game');

        tree.innerHTML += `
                    <div class="game-cover" >
                        <div class="buu">
                        <div class="buy" id="${element.id}">
                            <span class="icon">
                                <ion-icon name="cart-outline"></ion-icon>
                            </span>
                            Добавить в корзину
                        </div>
                        </div>
                        <figure class='image is-full'>
                            <img src="images/${element.cover_game}" alt="${element.name_game}">
                        </figure>
                    </div >
            <div class="game-description">
                <div class="game-title">
                    <h3 class="h1-game-name">
                        <a href="/game?id=<?=$game->id;?>" class="game-name">
                            ${element.name_game}
                        </a>
                    </h3>
                </div>
                <div class="game-company">
                    ${element.company.name_company}
                </div>
                <div class="game-price">
                    ${element.base_price} &#x20bd
                    <span class="discount">-${element.tax}%</span>
                </div>
            </div>`

        dashboard.append(tree);
    }
}