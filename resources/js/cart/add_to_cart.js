import { notification } from '../notification/swal'

document.querySelectorAll(".buy").forEach(btn =>
    btn.addEventListener("click", () => addGameToCart(btn.id))
);

function addGameToCart(id) {
    notification("Товар под номером " + id + " в корзине");
}