/**
 * валидатор для авторизации и регистрации
 */

export function auth_validate() {
  const phone = document.querySelector('#phone').value;
  const password = document.querySelector('#password').value;

  const resultPhone = validatePhone(phone);
  const resultPassword = validatePassword(password);

  if (resultPhone && resultPassword) return true;

  return false;
}

function validatePhone(phone) {
  if (phone === '') {
    printError('phoneErrDiv', 'Телефон не введен!');
    return false;
  }
  const regex = /\d/; // здесь указывать условия отбора
  if (regex.test(phone) === false) {
    printError('phoneErrDiv', 'Телефон не подходит!');
    return false;
  }
  printError('phoneErrDiv', '');
  return true;
}

function validatePassword(password) {
  if (password === '') {
    printError('passwordErrDiv', 'Пароль не введен!');
    return false;
  }
  const regex = /[a-z]/; // здесь указывать условия отбора
  if (regex.test(password) === false) {
    printError('passwordErrDiv', 'Пароль не подходит!');
    return false;
  }
  printError('passwordErrDiv', '');
  return true;
}

function printError(divId, text) {
  document.getElementById(divId).innerHTML = text;
}
