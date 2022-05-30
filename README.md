# Редизайн Steam для группы web-разработки :rocket:

[![Latest Version on Github](https://img.shields.io/badge/release-v1.2.4-red)](https://github.com/ToltekPlus/steam/releases/tag/v1.0.3)
![example workflow](https://github.com/ToltekPlus/steam/actions/workflows/main.yml/badge.svg)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE.md)

## Требования

> PHP 7.4+
>
> node 16+
>
> MySQL 5.7+

## Установка

- Клонируем проект

```
git clone https://github.com/ToltekPlus/steam.git .
```

- Устанавливаем все зависимости

```
composer install
npm install
```

- Создаем `.env` файл и подключаем свои данные для работы

```
cp .env.example .env
```

## Использование

### _БД и тестовые записи_

У вас должна присутствовать пустая БД, с которой вы будете работать.

В проекте уже настроены миграции и сидеры. Мы используем [Phinx migrations generator](https://github.com/odan/phinx-migrations-generator) и
для того, чтобы совершить миграции в БД, нужно запустить команду

```
vendor\bin\phinx migrate
```

Следующий шаг - сидеры для заполнения тестовыми данными. В директории `database/seeds` уже есть главный MainSeeder, который по цепочке запускает остальные файлы

```
vendor\bin\phinx seed:run -s MainSeeder
```

### _Использование JS и CSS файлов_

В проекте для работы с css-файлами используется `sass`, который собираются с помощью `webpack`. Также им собирается и js-файлы.

Билд файлов компилируется в каталог `public/js` для JS и `public/styles` для CSS соответственно.

Подключение файлов производится в файлах `resources/sass/app.sass` и `resourses/js/app.js`

Чтобы отслеживать общий подход к написанию js-кода и стилистики рекомендуется использовать `eslint` и `prettier`.
Запустить работу этих пакетов можно через команду `npm run eslint -- --fix`

### _Медиа_

Для работы с медиа-данными мы используем символические ссылки, пути которых настраиваются в `.env` файле.

## Branches

Для добавления, исправления функционала используется следующий подход:

- переход на ветку команды (например, `dev-cart`)
- добавление своей ветки (например, `dev-cart_fix-stage`)
- pull-request для своей команды в общую ветку
- pull-request от главного своей команды в `dev` ветку

## Continuous Integration

![CI](https://hsto.org/r/w1560/webt/eu/y-/xc/euy-xcul0bvx8zvzhpz2uvr_0tk.png)
Для прогона перед пушем коммит идет в `circleci`. Там проект собирается, тестируются миграции и сидеры и возвращается результат.
Если проект не билдится, то вываливается ошибка, и пулл-реквест (или мержинг) не происходит до исправления ошибок.
Настройка находится по адресу `.circleci/config.yml`.

## Contributing

Пожалуйста, просмотрите [CONTRIBUTING](CONTRIBUTING.md) и [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) для подробностей.

## License

The MIT License (MIT). Смотрите [License File](LICENSE) для деталей.
