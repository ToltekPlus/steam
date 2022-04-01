/**
 * валидатор для авторизации и регистрации
 */

export function auth_validate()
{
	let phone = document.getElementById('phone').value;
    let password = document.getElementById('password').value;

    let resultPhone = validatePhone(phone);
    let resultPassword = validatePassword(password);

    if (resultPhone && resultPassword) return true;

    return false;
}

function validatePhone(phone)
{
	if(phone == "") {
		printError("phoneErrDiv", "Телефон не введен!");
        return false;
    } else {
        var regex = /[0-9]/;   //здесь указывать условия отбора
        if(regex.test(phone) === false) {
        	printError("phoneErrDiv", "Телефон не подходит!");
            return false;
        } else{
        	printError("phoneErrDiv", "");
            return true;
        }
    }
}

function validatePassword(password)
{
	if(password == "") {
        printError("passwordErrDiv", "Пароль не введен!");
        return false;
    } else {
        var regex = /[a-z]/;   //здесь указывать условия отбора
        if(regex.test(password) === false) {
            printError("passwordErrDiv", "Пароль не подходит!");
            return false;
        } else{
        	printError("passwordErrDiv", "");
            return true;
        }
    }
}

function printError(divId, text) {
    document.getElementById(divId).innerHTML = text;
}