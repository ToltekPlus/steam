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
    let arrKeys = [];

    let operation = identityRoute.shift();

    let cart = JSON.parse(localStorage.getItem('steamCart'));

    cart.forEach((item) => {
        arrKeys.push(parseInt(item.id));
    })

    const send = sendData(arrKeys, operation.action, operation.header);

    send(arrKeys)
        .then((response) => {
            // TODO вывести html в браузер с данными
        })
        .catch((err) => console.error(err));
}