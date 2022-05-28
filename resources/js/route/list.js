export function list() {
  return [
    {
      page: 'add',
      action: 'store',
      redirect: '',
      message: 'Данные добавлены',
      message_error: 'Произошла ошибка',
    },
    {
      page: 'edit',
      action: 'update',
      redirect: '/account/edit',
      message: 'Данные обновлены',
      message_error: 'Произошла ошибка',
    },
    {
      page: 'list',
      action: 'delete',
      redirect: 'list',
      message: 'Данные удалены',
      message_error: 'Произошла ошибка',
    },
    {
      page: 'basket',
      action: 'getProducts',
      header: 'application/x-www-form-urlencoded',
    },
  ];
}
