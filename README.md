**Установка**
- Установить PHP <a>https://www.php.net/downloads</a>
- Установить Nodejs <a>https://nodejs.org/en/download</a> **Не меньше 14 версии**
- Установить Composer <a>https://getcomposer.org/</a>
- Клонировать репозиторий `git clone <link>`
- Скачать модули node `npm i`
- Добавить composer `composer i`
---
**Запуск**
- Создать файл конфигурации с примера `copy .env.example .env`
>*Файл .env* <br> - Отредактировать файл конфигурации
- Создать ключ приложения `php artisan key:generate`
- Создать локальное хранилище `php artisan storage:link`
- Мигрировать таблицы `php artisan migrate`
- Запустить приложения `npm run dev` и `php artisan serve`

--- 
- Необходимо подключение API 
- Получение и обработка данных 
