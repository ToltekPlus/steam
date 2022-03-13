/**
 * Определяем роуты и ищем совпадения
 *
 * Если совпадения найдены, то подготавлием элементы для построения html
 * Проверяем, есть ли в корзине информация. Если нет, то возвращаем на главную
 *
 * По id из localStorage забираем с сервера нужные для нас данные
 * Строим html данные
 *
 * Вешаем на элементы с удалением id элемента
 * И через секунду запускаем функцию с удалением (т.к. DOM-дерево сперва не имеет информацию о данных корзины)
 *
 * Для удаления перебираем все элементы с требуемым классом и кидаем в функцию удаления
 *
 * Дублирем проверку на наличие корзины
 *
 * Релодимся на страницу с корзиной, чтобы обновить информацию с древом
 *
 */

// TODO декомпозировать код, убрать дублирующие куски
// TODO при добавлении товаров дублируется корзина
// TODO обновлять html после удаления ассинхронно

import { sendData } from "../db/send";
import { identity_route } from "./identity_route";
import { list } from "../route/list";
import { deleteFromLocaleStorage } from "./delete_product_from_cart";
import { productInCart } from "./brief_cart";

// определяем поведение для работы с корзиной
let type = list();

let identityRoute = identity_route(type);

if (identityRoute.length) {
    let product = document.createElement('div');
    product.classList.add("basket-products");

    let cartDataInfo = document.createElement('div');

    let basket = document.getElementById("basket");

    let cartData = document.getElementById("cart-data");

    let finalPrice = 0;

    let countProducts = 0;

    let arrKeys = [];

    let operation = identityRoute.shift();

    let cart = JSON.parse(localStorage.getItem('steamCart'));
    if (!cart.length) {
        window.setTimeout( function(){
            window.location = '/';
        }, 500 );
    }

    cart.forEach((item) => {
        arrKeys.push(parseInt(item.id));
    })

    const send = sendData(arrKeys, operation.action, operation.header);

    send(arrKeys)
        .then((response) => {
            let result = JSON.parse(response)
            result.forEach((item, key) => {
                finalPrice = finalPrice + cart[key].count * item.base_price;
                countProducts = countProducts + cart[key].count;
                product.innerHTML += "<div class='product-in-cart__image'><img src='images/administrator/" + item.cover_game + "' alt='" + item.name_game + "'></div>"
                    + "<div class='product-in-cart__description'>"
                    + "<h2 class='<h2'>" + item.name_game + "</h2>"
                    + "<div class='product-in-cart__company-information'>"+ item.company.name_company +"</div>"
                    + "<div class='product-in-cart__price-information'>" + item.base_price +" &#x20bd"
                    + "<span>(x" + cart[key].count + ")</span>"
                    + "<span class='discount'>"+ item.tax.tax +" %</span></div>"
                    + "<div class='product-in-cart__product-categories'><ul class='column is-12'><li>"+ item.genre.name_genre +"</li></ul></div>"
                    + "<div class='product-in-cart__delete-from-cart'><a class='delete-link' data-el='" + cart[key].id + "' id='" + cart[key].id + "'>удалить из корзины</a></div>"
                    + "</div>";

                basket.append(product);
            })

            cartDataInfo.innerHTML += countProducts + "<br>" + finalPrice + "&#x20bd <br>";
            cartData.append(cartDataInfo);
        })
        .catch((err) => console.error(err));

    setTimeout(deleteFromCart, 1000);
}

function deleteFromCart() {
    [...document.getElementsByClassName("delete-link")].forEach(el => el.addEventListener('click', event => {
        deleteFromLocaleStorage(event.target.getAttribute("data-el"));

        let elem = document.getElementsByClassName("cart-products")[0];
        if (elem) { elem.parentNode.removeChild(elem) }
        productInCart();

        window.setTimeout( function(){
            window.location = '/basket';
        }, 500 );
    }))
}