export function tree_container(response, dashboard) {
    let result = JSON.parse(response);
    // удаляем все дочерние элементы с играми
    while (dashboard.firstChild) {
        dashboard.firstChild.remove();
    }

    for (let i = 0; i < result.length; i++) {
        let tree = document.createElement('div');
        tree.classList.add("column");
        tree.classList.add("is-one-quarter");
        tree.classList.add("game");

        tree.innerHTML += `
                    <div class="game-cover">
                        <div class="buy" id="` + result[i].id + `">
                            <span class="icon">
                                <ion-icon name="cart-outline"></ion-icon>
                            </span>
                            Добавить в корзину
                        </div>
                        <figure class='image is-full'>
                            <img src="images/administrator/` + result[i].cover_game + `" alt=`+ result[i].name_game +`>
                        </figure>
                    </div>
                    <div class="game-description">
                        <div class="game-title">
                            ` + result[i].name_game + `
                        </div>
                        <div class="game-company">
                            ` + result[i].company.name_company + `
                        </div>
                        <div class="game-price">
                            ` + result[i].base_price + ` &#x20bd
                            <span class="discount">-` + result[i].tax + `%</span>
                        </div>
                    </div>`

        dashboard.append(tree);
    }
}