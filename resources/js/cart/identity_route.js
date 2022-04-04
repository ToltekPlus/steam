/**
 * Принимает данные url, которые будем обрабатывать
 * Фильтруем по совпадению url-адреса
 * Возвращаем результат
 *
 */
export function identity_route(data) {
  // собираем url без get параметров
  const urlPATH = window.location.origin + window.location.pathname;

  // ищем соответствующий метод для работы
  const searchRoute = data.filter(item => {
    return item.page === urlPATH.split('/').pop();
  });

  return searchRoute;
}
