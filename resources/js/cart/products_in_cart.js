import { sendData } from "../db/send";

// определяем поведение для работы с корзиной
let basket =  [
    {
        "page": "basket",
        "action": "getProducts",
        "header": "application/x-www-form-urlencoded"
    }
];

// собираем url без get параметров
let urlPATH = window.location.origin + window.location.pathname;

// ищем соответствующий метод для работы
let identityRoute = basket.filter(item => {
    return item.page === urlPATH.split('/').pop();
});

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
                    + "</div>";

                basket.append(product);
            })

            cartDataInfo.innerHTML += countProducts + "<br>" + finalPrice + "&#x20bd <br>";
            cartData.append(cartDataInfo);
        })
        .catch((err) => console.error(err));
}