export function get_games() {
    return async () => {
        const fetchResponse = await fetch('http://steam.local/v1/games/all');

        if (!fetchResponse.ok) {
            throw new Error(
                `Ошибка по адресу ${url}, статус ошибки ${fetchResp.status}`,
            );
        }
        return await fetchResponse.text();
    };
}



