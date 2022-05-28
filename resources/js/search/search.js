/**
 * Это реализация ФИЛЬТРА, а не поиска
 *
 * Для фильтрации сперва мы загружаем отсортированный список игр
 * по подобию API (см. https://ru.wikipedia.org/wiki/API)
 *
 * Затем вешаем слушателя на отжатие клавивиши на клавиатуре и сортирует в регистре
 * по букве в нашем массиве игр
 *
 * Если соответствие найдено, то создаем дерево из элементов и выводим его
 */

import { get_games } from "../api/get_games_for_search";

var gamesForSearch = [];

const searchField = document.querySelector('#searchField');

const games = get_games();
games()
    .then(response => {
        gamesForSearch.push(JSON.parse(response));
    })
    .catch(error => {
        console.log(error)
    });

document.getElementById('searchBlock').addEventListener('keydown', (searchInput) => {
    searchField.innerHTML = '';

    const filteredData = gamesForSearch[0].filter(value => {
        const searchStr = searchInput.key.toLowerCase();
        const nameMatches = value.game_name.toLowerCase().includes(searchStr);

        return nameMatches;
    });

    for (const element of filteredData) {
        const tree = document.createElement('div');
        tree.innerHTML += `<div><a href="game?id=${element.game_id}">${element.game_name}</a></div>`
        searchField.append(tree);
    }
});
