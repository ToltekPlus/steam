export function list() {
    return [
        {
            "page": "add",
            "action": "store",
            "redirect": "",
            "message": "Данные добавлены"
        },
        {
            "page": "edit",
            "action": "update",
            "redirect": "",
            "message": "Данные обновлены"
        },
        {
            "page": "list",
            "action": "delete",
            "redirect": "list",
            "message": "Данные удалены"
        }
    ];
}