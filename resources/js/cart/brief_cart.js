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

import { sendData } from '../db/send';
import { deleteFromLocaleStorage } from './delete_product_from_cart';

const linkBrief = document.querySelector('#briefCart');

// TODO при быстром тапе увеличивается количество элементов
document.querySelector('#briefCart').addEventListener('click', function (e) {
  const elem = document.querySelectorAll('.cart-products')[0];

  if (elem) {
    elem.remove();
  }

  productInCart();
});

export function productInCart() {
  if (linkBrief) {
    const cart = JSON.parse(localStorage.getItem('steamCart'));

    // определяем поведение для работы с корзиной
    const basket = {
      header: 'application/x-www-form-urlencoded',
    };

    const cartContent = document.querySelector('#cartContent');

    const cartProducts = document.createElement('div');
    cartProducts.classList.add('cart-products');

    const product = document.createElement('div');
    product.classList.add('product-in-cart');

    const finalPriceInCart = document.createElement('div');
    finalPriceInCart.classList.add('product-in-cart__final-price');

    if (cart.length === 0) {
      // TODO если корзира уже была постая, то удлять этот блок
      const emptyCart = document.createElement('div');
      emptyCart.classList.add('empty-cart');

      emptyCart.innerHTML =
        "<div style='text-align: center;'>Корзина пустая :(</div>";
      cartContent.append(emptyCart);
    }

    let finalPrice = 0;

    const path = 'cart/brief';

    const arrKeys = [];
    for (const item of cart) {
      arrKeys.push(Number.parseInt(item.id));
    }

    const send = sendData(arrKeys, path, basket.header);

    send(arrKeys)
      .then(response => {
        const result = JSON.parse(response);
        for (const [key, item] of result.entries()) {
          finalPrice += cart[key].count * item.price;
          product.innerHTML +=
            `<div class='product-in-cart__title'>${item.name_game}<span class='product-in-cart__count'>(x${cart[key].count})</span>` +
            `<div class='product-in-cart__price'>${item.price}<label class='product-in-cart__delete' data-el='${cart[key].id}' id='${cart[key].id}'>удалить</label></div>` +
            `</div>`;
          finalPriceInCart.innerHTML =
            `<div class='product-in-cart__price'>Финальная цена: ${finalPrice}</div>` +
            `<div class='arange'><a href='/basket'>Оформить</a></div>`;
          cartProducts.append(product);
          cartProducts.append(finalPriceInCart);
          cartContent.append(cartProducts);
        }
      })
      .catch(error => {
        console.log(error);
      });

    setTimeout(deleteFromCart, 1000);
  }
}

function deleteFromCart() {
  for (const el of document.querySelectorAll('.product-in-cart__delete'))
    el.addEventListener('click', event => {
      deleteFromLocaleStorage(event.target.dataset.el);

      const elem = document.querySelectorAll('.cart-products')[0];
      if (elem) {
        elem.remove();
      }
      productInCart();
    });
}
