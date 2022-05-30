import { notification } from '../notification/swal';
import { get_session } from '../db/get_session';
import { productInCart } from './brief_cart';

let status;

for (const btn of document.querySelectorAll('.buy'))
  btn.addEventListener('click', () => addGameToCart(btn.id));

function get_session_id() {
  const send_session = get_session('get_auth');
  send_session()
    .then(response => {
      if (response.length === 0) {
        notification('Вы не авторизованы', 'error');
        status = 0;
      }
    })
    .catch(error => console.error(error));
}

function addGameToCart(id) {
  get_session_id();

  if (status != undefined) {
    return false;
  }

    var base_price = document.getElementById(id);
    var price = base_price.dataset.base_price
    console.log(price)

    const cart = JSON.parse(localStorage.getItem('steamCart')) || [];

  // ищем товар в корзине
  let newProduct = cart.find(product => product.id === id);

    // если продукт уже есть в корзине, то увеличиваем его количесвтво
    // иначе добавляем новый продукт
    if (newProduct) {
      newProduct.count = newProduct.count + 1;
      newProduct.finalPrice = price * newProduct.count;
  }else {
      newProduct = { 'id': id, 'game_id' : id, 'count': 1, 'finalPrice' : price };
      cart.push(newProduct);
  }

  /*// если продукт уже есть в корзине, то увеличиваем его количесвтво
  // иначе добавляем новый продукт
  if (newProduct) {
    newProduct.count += 1;
  } else {
    newProduct = { id, count: 1 };
    cart.push(newProduct);
  }*/

  localStorage.setItem('steamCart', JSON.stringify(cart));

  productInCart();

  notification(`Товар под номером ${id} в корзине`);
}
