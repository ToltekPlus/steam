import { notification } from '../notification/swal'
import { get_session } from '../db/get_session'

let status;

document.querySelectorAll(".buy").forEach(btn =>
    btn.addEventListener("click", () => addGameToCart(btn.id))
);

function get_session_id() {
    let send_session = get_session('get_auth');
    send_session()
        .then((response) => {
            if (!response.length) {
                notification("Вы не авторизованы", "error");
                status = 0;
            }
        })
        .catch((err) => console.error(err));
}

function addGameToCart(id) {
    get_session_id();

    if (status != undefined) {
        return false;
    }

    let cart = JSON.parse(localStorage.getItem('steamCart')) || [];

    // ищем товар в корзине
    let newProduct = cart.find(product => product.id === id);

    // если продукт уже есть в корзине, то увеличиваем его количесвтво
    // иначе добавляем новый продукт
    if (newProduct) {
        newProduct.count = newProduct.count + 1;
    }else {
        newProduct = { 'id': id, 'count': 1 };
        cart.push(newProduct);
    }

    localStorage.setItem('steamCart', JSON.stringify(cart));

    notification("Товар под номером " + id + " в корзине");
}