# Учебный проект по Symfony Модуль 6-7: "Связи в Doctrine"
## Cat-Cas-Car
Это учебный проект по фреймворку Symfony на курсе Skillbox. Модуль 6-7: "Связи в Doctrine"
 
Автор курса: **[Волков Михаил](https://mvsvolkov.ru)**

## Установка
Выберите нужную версию по тегу и скачайте проект

**Установите зависимости**

Для этого вам понадобится [установленный Composer](https://getcomposer.org/download/)
а затем выполните:

```
composer install
```

**Сконфигурируйте файл .env**

Обязательный параметр для конфигурации: `DATABASE_URL`.

**Установка Базы данных**

Убедитесь что параметр `DATABASE_URL` настроен корректно, и выполните следующие команды

```
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```


**Скомпилируйте Webpack Encoder Assets**

Убедитесь, что у вас установлен [yarn](https://yarnpkg.com/lang/en/)
а затем выполните:

```
yarn install
yarn run dev
```

**Запустите веб-сервер**

Для этого вам понадобится [приложение symfony](https://symfony.com/download)

```
symfony serve
```

Заходите на `http://localhost:8000`

Изучайте!

***Примечание***

Проект был создан с использованием следующих версий приложений:

```
php: 7.4
composer: 2
nodejs: 14
yarn: 1.22
```

При использовании других версий, могут возникнуть сложности при запуске демонстрационного проекта.

В этом случае вы можете попробовать выполнить следующие команды, но 100% работоспособность не гарантируется:

- в случае ошибок установки зависимостей composer:

```
composer update
```

- В случае ошибки запуска сборщика скриптов:

```
rm -rf node_modules
yarn upgrade && yarn install
```
