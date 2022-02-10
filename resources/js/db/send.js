export function sendData(formData, action) {
    return async (formData) => {
        const fetchResponse = await fetch(action, {
            method: 'POST',
            body: formData
        });
        if (!fetchResponse.ok) {
            throw new Error(`Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`);
        }
        return await fetchResponse.text();
    };
}