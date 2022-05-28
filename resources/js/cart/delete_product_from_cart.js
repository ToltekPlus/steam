/**
 * Принимаем id элемента, который нужно удалить
 * Включаем функцию фильтрации localStorage, оставляя все что не соответствует id
 *
 * Перезаписываем localStorage уже с обновленными данными
 *
 */
export function deleteFromLocaleStorage(id) {
  const productsInCart = JSON.parse(localStorage.getItem('steamCart'));
  const filtered = productsInCart.filter(item => item.id !== id);
  localStorage.setItem('steamCart', JSON.stringify(filtered));
}
