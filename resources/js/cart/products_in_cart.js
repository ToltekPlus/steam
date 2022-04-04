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

import { sendData } from '../db/send';
import { identity_route } from './identity_route';
import { list } from '../route/list';
import { deleteFromLocaleStorage } from './delete_product_from_cart';
import { productInCart } from './brief_cart';

// определяем поведение для работы с корзиной
const type = list();

const identityRoute = identity_route(type);

if (identityRoute.length > 0) {
  const product = document.createElement('div');
  product.classList.add('basket-products');

  const cartDataInfo = document.createElement('div');

  const basket = document.querySelector('#basket');

  const cartData = document.querySelector('#cart-data');

  let finalPrice = 0;

  let countProducts = 0;

  const arrKeys = [];

  const operation = identityRoute.shift();

  const cart = JSON.parse(localStorage.getItem('steamCart'));
  if (cart.length === 0) {
    window.setTimeout(function () {
      window.location = '/';
    }, 500);
  }

  for (const item of cart) {
    arrKeys.push(Number.parseInt(item.id));
  }

  const send = sendData(arrKeys, operation.action, operation.header);

  send(arrKeys)
    .then(response => {
      const result = JSON.parse(response);
      for (const [key, item] of result.entries()) {
        finalPrice += cart[key].count * item.base_price;
        countProducts += cart[key].count;
        product.innerHTML +=
          `<div class='product-in-cart__image'><img src='images/administrator/${item.cover_game}' alt='${item.name_game}'></div>` +
          `<div class='product-in-cart__description'>` +
          `<h2 class='<h2'>${item.name_game}</h2>` +
          `<div class='product-in-cart__company-information'>${item.company.name_company}</div>` +
          `<div class='product-in-cart__price-information'>${item.base_price} &#x20bd` +
          `<span>(x${cart[key].count})</span>` +
          `<span class='discount'>${item.tax.tax} %</span></div>` +
          `<div class='product-in-cart__product-categories'><ul class='column is-12'><li>${item.genre.name_genre}</li></ul></div>` +
          `<div class='product-in-cart__delete-from-cart'><a class='delete-link' data-el='${cart[key].id}' id='${cart[key].id}'>удалить из корзины</a></div>` +
          `</div>`;

        basket.append(product);
      }

      cartDataInfo.innerHTML += `${countProducts}<br>${finalPrice}&#x20bd <br>`;
      cartData.append(cartDataInfo);
    })
    .catch(error => console.error(error));

  setTimeout(deleteFromCart, 1000);
}

function deleteFromCart() {
  for (const el of document.querySelectorAll('.delete-link'))
    el.addEventListener('click', event => {
      deleteFromLocaleStorage(event.target.dataset.el);

      const elem = document.querySelectorAll('.cart-products')[0];
      if (elem) {
        elem.remove();
      }
      productInCart();

      window.setTimeout(function () {
        window.location = '/basket';
      }, 500);
    });
}
