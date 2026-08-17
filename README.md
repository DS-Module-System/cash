# Cash

Касови приходи и разходи с дата, сума, тип и създател.

## Функционалност

- CRUD на касови транзакции
- Типове: приход и разход
- Търсене по дата, сума, тип и създател
- Автоматично записване на създателя и датата на въвеждане

## Интеграция в системата

Copy-in модул: файловете се копират в хоста под `App\`.

- Пътища: `src/Controller|Entity|Enum|Form|Repository/Cash/`, `templates/cash/`, `translations/cash.*.yaml`, `config/roles/cash.yaml`
- Меню: Каса (`cash_list`) при `ROLE_CASH_VIEW`
- Роли: `ROLE_CASH_{VIEW,CREATE,EDIT,DELETE}`
- Маршрути: `/cash`

Самостоятелен финансов модул — не се връзва към фактури или склад.

## Структура

- `CashTransactionController`
- Ентитет: `CashTransaction`
- Enum: `CashTransactionType`
- Форми: транзакция и търсене

## Зависимости

- **erp-core** — базов CRUD, `BaseUser`

## Документация

- [docs/cash/README.md](docs/cash/README.md)
- [docs/cash/installation-guide.md](docs/cash/installation-guide.md)
- [docs/cash/quick-start.md](docs/cash/quick-start.md)
