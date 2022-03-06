export function sendData(formData, action) {
    return async (formData) => {
        const fetchResponse = await fetch(action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'content-type': 'application/x-www-form-urlencoded'
            }
        });
        if (!fetchResponse.ok) {
            throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResponse.text();
    };
}