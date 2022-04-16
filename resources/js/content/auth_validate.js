/**
 * Проверка данных
 *
 * @returns {boolean}
 */
export function auth_validate() {
  const phone = document.querySelector('#phone').value;
  const password = document.querySelector('#password').value;

  const resultPhone = validatePhone(phone);
  const resultPassword = validatePassword(password);

  if (resultPhone && resultPassword) return true;

  return false;
}

/**
 * Провепяем длину телефона
 *
 * @param phone
 * @returns {boolean}
 */
function validatePhone(phone) {
  if (phone.replace(/\D/g, '').length != 11) {
    return false;
  }
  return true;
}

/**
 * Проверяем длину пароля
 *
 * @param password
 * @returns {boolean}
 */
function validatePassword(password) {
  if (password.trim().length < 5) {
    return false;
  }
  return true;
}
