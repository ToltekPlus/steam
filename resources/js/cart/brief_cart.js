import { sendData } from "../db/send";

var linkBrief = document.getElementById("briefCart");

// TODO при быстром тапе увеличивается количество элементов
document.getElementById('briefCart').addEventListener('click', function (e) {
    let elem = document.getElementsByClassName("cart-products")[0];

    if (elem) { elem.parentNode.removeChild(elem) }

    productInCart();
});

export function productInCart() {
    if (linkBrief) {
        let cartContent = document.getElementById("cartContent");

        let cartProducts = document.createElement('div');
        cartProducts.classList.add("cart-products");

        let product = document.createElement('div');
        product.classList.add("product-in-cart");

        let finalPriceInCart = document.createElement('div');
        finalPriceInCart.classList.add("product-in-cart__final-price");

        let finalPrice = 0;

        let path = "cart/brief"

        let cart = JSON.parse(localStorage.getItem('steamCart')) || [];

        let result = [];
        cart.forEach((c) => {
            result.push(parseInt(c.id));
        });

        const send = sendData(result, path)

        send(result)
            .then(response => {
                let result = JSON.parse(response)
                result.forEach((item, key) => {
                    finalPrice = finalPrice + cart[key].count*item.price;
                    product.innerHTML += "<div class='product-in-cart__title'>"
                        +item.name_game+"<span class='product-in-cart__count'>(x"+cart[key].count+")</span>"
                        +"<div class='product-in-cart__price'>"+item.price+"<span class='product-in-cart__delete' id='test'>удалить</span></div>"
                        +"</div>";
                    finalPriceInCart.innerHTML = "<div class='product-in-cart__price'>Финальная цена: "+finalPrice+"</div>";
                    cartProducts.append(product);
                    cartProducts.append(finalPriceInCart)
                    cartContent.append(cartProducts);
                })
            })
            .catch(error => {
                console.log(error)
            })
    }
}

