import { sendData } from "../db/send";

let selector = {
    "path": "selector",
    "header": "application/x-www-form-urlencoded"
};

let dashboard = document.getElementById('dashboard');

let gameCover = document.createElement('div');
gameCover.classList.add("game-cover");

let buy = document.createElement('div');
buy.classList.add("buy");

let tree = document.createElement('div');
tree.classList.add("column");
tree.classList.add("is-one-quarter");
tree.classList.add("game");

document.getElementById('selector-games').addEventListener('change', function() {
    const send = sendData(this.value, selector.path, selector.header);

    send(this.value)
        .then(response => {
            let result = JSON.parse(response);
            // удаляем все дочерние элементы с играми
            while (dashboard.firstChild) {
                dashboard.firstChild.remove();
            }

            result.forEach((item, key) => {
                tree.append(gameCover);

                //buy.id = item.id;
                //buy.innerHTML += `<span class="icon"><ion-icon name="cart-outline"></ion-icon></span>Добавить в корзину`;
                tree.append(buy);

                dashboard.append(tree);
            });
        })
        .catch(error => {
            console.log(error)
        })
});