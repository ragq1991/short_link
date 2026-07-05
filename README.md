# Инструкция по развёртыванию проекта short_link

## Требования

- PHP 8.1+
- Composer
- MySQL (или MariaDB)
- Node.js + npm
- Git

## 1. Клонирование репозитория

```bash
git clone <ссылка на репозиторий>
cd short_link
```

## 2. Установка зависимостей

```bash
composer install
npm install
```

## 3. Настройка окружения

```bash
cp .env.example .env
php artisan key:generate
```

Открой `.env` и укажи настройки базы данных:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_links
DB_USERNAME=root
DB_PASSWORD=
```

Создай базу данных с именем, указанным в `DB_DATABASE` (например, через phpMyAdmin, DBeaver или консоль MySQL):

```sql
CREATE DATABASE test_links CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

## 4. Миграции и тестовые данные

```bash
php artisan migrate
php artisan db:seed --class=DemoDataSeeder
```

Это создаст:
- Админа: `admin@example.com` / `password`
- Обычного пользователя: `user@example.com` / `password`
- 5 ссылок на обычного пользователя (google.com, youtube.com, github.com, wikipedia.org, laravel.com)
- По 5 переходов (со случайным IP и датой) на каждую ссылку

## 5. Сборка фронтенда

```bash
npm run build
```

(для разработки с автообновлением: `npm run dev` в отдельном терминале)

## 6. Запуск сервера

```bash
php artisan serve
```

Проект будет доступен по адресу `http://127.0.0.1:8000`.

## 7. Доступы

| Роль | URL панели | Email | Пароль |
|---|---|---|---|
| Админ | http://127.0.0.1:8000/admin | admin@example.com | password |
| Пользователь | http://127.0.0.1:8000/app | user@example.com | password |

Новые пользователи также могут зарегистрироваться самостоятельно через `http://127.0.0.1:8000/app/register`.

## 8. Проверка редиректа

В личном кабинете (`/app/links`) скопируй короткую ссылку любой записи (вида `http://127.0.0.1:8000/AbCd12`) и открой её в браузере — должен произойти редирект на оригинальный URL, а переход зафиксируется в статистике (видно на странице редактирования ссылки).

## Возможные проблемы

- **`SQLSTATE[HY000] [1045] Access denied`** — проверь логин/пароль от MySQL в `.env`.
- **Ошибка при `npm run build`** — убедись, что версия Node.js 18+ (`node -v`).
- **`Route [login] not defined`** — проверь, что в `AdminPanelProvider`/`AppPanelProvider` подключены методы `->login()` и `->registration()`.
- Если email `admin@example.com` или `user@example.com` уже заняты — удали пользователей перед повторным сидированием:
  ```bash
  php artisan tinker --execute="\App\Models\User::whereIn('email', ['admin@example.com', 'user@example.com'])->delete();"
  ```
