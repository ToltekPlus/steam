export function get_session(action) {
  return async () => {
    const fetchResponse = await fetch(action, {
      method: 'POST',
    });
    if (!fetchResponse.ok) {
      throw new Error(
        `Ошибка по адресу ${url}, статус ошибки ${fetchResponse.status}`,
      );
    }
    return await fetchResponse.text();
  };
}
