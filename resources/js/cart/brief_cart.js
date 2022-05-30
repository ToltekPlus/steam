/**
 * Вешаем слушателя на элемент вызова модального окна
 * При клике на этот элемент забираем всю информацию, которая была до этом в окне
 * Если информация была, то уничтожаем все дочерние элементы. После вызываем залив информации из localStorage
 *
 * Определяем поведение с корзиной - если нам нужно загрузить информацию, то будем использовать
 * нужный для нас header
 * Далее определяем элементы из которых будет состоять корзина и путь по которому будет забирать информацию о товарах
 * Забираем информацию из localStorage, перебираем и забираем только id элементов
 * Ассинхроно подготавливаем информацию для вывода в then получаем response и составляем html-элементы и динамической информацией
 * Вешаем на label с удалением id элемента
 * И через секунду запускаем функцию с удалением (т.к. DOM-дерево сперва не имеет информацию о данных корзины)
 *
 * Для удаления перебираем все элементы с требуемым классом и кидаем в функцию удаления
 *
 * Дублирем проверку на наличие корзины
 *
 */


import { sendData } from "../db/send";
import { deleteFromLocaleStorage } from "./delete_product_from_cart";

var linkBrief = document.getElementById("briefCart");

// TODO при быстром тапе увеличивается количество элементов
document.getElementById('briefCart').addEventListener('click', function (e) {
    let elem = document.getElementsByClassName("cart-products")[0];

    if (elem) { elem.parentNode.removeChild(elem) }

    productInCart();
});

export function productInCart() {
    if (linkBrief) {
        // определяем поведение для работы с корзиной
        let basket = {
            "header": "application/x-www-form-urlencoded"
        };

        let cartContent = document.getElementById("cartContent");

        let cartProducts = document.createElement('div');
        cartProducts.classList.add("cart-products");

        let product = document.createElement('div');
        product.classList.add("product-in-cart");

        let finalPriceInCart = document.createElement('div');
        finalPriceInCart.classList.add("product-in-cart__final-price");

        let finalPrice = 0;

        let path = "cart/brief";

        let cart = JSON.parse(localStorage.getItem('steamCart'));

        let arrKeys = [];
        cart.forEach((item) => {
            arrKeys.push(parseInt(item.id));
        })

        const send = sendData(arrKeys, path, basket.header);

        send(arrKeys)
            .then(response => {
                let result = JSON.parse(response)
                result.forEach((item, key) => {
                    finalPrice = finalPrice + cart[key].count * item.price;
                    product.innerHTML += "<div class='product-in-cart__title'>"
                        + item.name_game + "<span class='product-in-cart__count'>(x" + cart[key].count + ")</span>"
                        + "<div class='product-in-cart__price'>" + item.price + "<label class='product-in-cart__delete' data-el='" + cart[key].id + "' game_id='" + cart[key].id + "'>удалить</label></div>"
                        + "</div>";
                    finalPriceInCart.innerHTML = "<div class='product-in-cart__price'>Финальная цена: " + finalPrice + "</div>" + "<div class='arange'><a href='/basket'>Оформить</a></div>";
                    cartProducts.append(product);
                    cartProducts.append(finalPriceInCart)
                    cartContent.append(cartProducts);
                })
            })
            .catch(error => {
                console.log(error);
            })

        setTimeout(deleteFromCart, 1000);
    }
}

function deleteFromCart() {
    [...document.getElementsByClassName("product-in-cart__delete")].forEach(el => el.addEventListener('click', event => {
        deleteFromLocaleStorage(event.target.getAttribute("data-el"));

        let elem = document.getElementsByClassName("cart-products")[0];
        if (elem) { elem.parentNode.removeChild(elem) }
        productInCart();
    }))
}