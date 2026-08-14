# Cash Module - Installation Guide

## Предварителни изисквания

- Symfony 7.3+
- PHP 8.4+
- MySQL/MariaDB
- Composer

## Инсталация

### 1. Клониране на проекта
```bash
git clone <repository-url>
cd ds-erp-module-system-test
```

### 2. Инсталиране на зависимости
```bash
composer install
```

### 3. Конфигурация на базата данни
Настройте връзката с базата данни в `.env` файла:
```env
DATABASE_URL="mysql://username:password@localhost:3306/database_name"
```

### 4. Създаване на базата данни
```bash
php bin/console doctrine:database:create
```

### 5. Изпълнение на миграции
```bash
php bin/console doctrine:migrations:migrate
```

### 6. Изчистване на кеша
```bash
php bin/console cache:clear
```

## Структура на файловете

### Entity
- `src/Entity/Cash/CashTransaction.php` - Основен entity клас
- `src/Enum/Cash/CashTransactionType.php` - Enum за типове транзакции

### Repository
- `src/Repository/Cash/CashTransactionRepository.php` - Repository клас

### Form
- `src/Form/Cash/CashTransactionForm.php` - Форма за създаване/редактиране
- `src/Form/Cash/CashTransactionSearchForm.php` - Форма за търсене

### Controller
- `src/Controller/Cash/CashTransactionController.php` - Контролер

### Templates
- `templates/cash/index.html.twig` - Списък на транзакции
- `templates/cash/form.html.twig` - Форма за създаване/редактиране

### Translations
- `translations/cash.bg.yaml` - Български преводи
- `translations/cash.en.yaml` - Английски преводи

## Конфигурация

### Меню интеграция
Модулът автоматично се добавя в главното меню чрез `src/Menu/Builder.php`.

### Routes
Всички routes се регистрират автоматично:
- `/cash` - Списък
- `/cash/create` - Създаване
- `/cash/{id}/edit` - Редактиране
- `/cash/deletes` - Изтриване

## Валидация

### Entity валидация
- `transactionDate` - Задължително поле
- `amount` - Задължително положително число
- `transactionType` - Задължително поле

### Form валидация
- Всички полета имат подходящи constraints
- Сумите се валидират като положителни числа
- Датите се валидират като валидни дати

## Тестване

### Проверка на routes
```bash
php bin/console debug:router | grep cash
```

### Проверка на entity
```bash
php bin/console doctrine:schema:validate
```

### Проверка на кеша
```bash
php bin/console cache:clear
```

## Troubleshooting

### Проблем: Routes не се зареждат
**Решение**: Изчистете кеша
```bash
php bin/console cache:clear
```

### Проблем: Миграции не се изпълняват
**Решение**: Проверете връзката с базата данни
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### Проблем: Translation не работи
**Решение**: Проверете translation файловете и изчистете кеша
```bash
php bin/console cache:clear
```

## Поддръжка

За техническа поддръжка и въпроси:
- Създайте issue в GitHub repository
- Свържете се с development team

## Обновяване

За обновяване на модула:
1. Pull последните промени
2. Изпълнете миграциите
3. Изчистете кеша
```bash
git pull
php bin/console doctrine:migrations:migrate
php bin/console cache:clear
``` 