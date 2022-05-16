export function sendData(formData, action, header = '') {
  // если желаем получить данные из корзины, то подключаем
  // заголовок
  const h = new Headers();
  if (header) {
    h.append('Content-Type', header);
  }

  return async formData => {
    const fetchResponse = await fetch(action, {
      method: 'POST',
      body: formData,
      headers: h,
    });
    if (!fetchResponse.ok) {
      throw new Error(
        `Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`,
      );
    }
    return await fetchResponse.text();
  };
}
