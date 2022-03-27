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
		console.log("телефон не введен");
		printError("phoneErrDiv", "Телефон не введен!");
        return false;
    } else {
        var regex = /[0-9]/;   //здесь указывать условия отбора
        if(regex.test(phone) === false) {
        	console.log("телефон не подходит");
        	printError("phoneErrDiv", "Телефон не подходит!");
            return false;
        } else{
        	console.log("телефон введен верно");
        	printError("phoneErrDiv", "");
            return true;
        }
    }
}

function validatePassword(password)
{
	if(password == "") {
        console.log("пароль не введен");
        printError("passwordErrDiv", "Пароль не введен!");
        return false;
    } else {
        var regex = /[a-z]/;   //здесь указывать условия отбора
        if(regex.test(password) === false) {
            console.log("пароль не подходит");
            printError("passwordErrDiv", "Пароль не подходит!");
            return false;
        } else{
        	console.log("пароль введен верно");
        	printError("passwordErrDiv", "");
            return true;
        }
    }
}

function printError(divId, text) {
    document.getElementById(divId).innerHTML = text;
}