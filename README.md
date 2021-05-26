 ﻿## TZ
  
 ## Необходимо реализовать API для авторизации клиента и администратора. 

### (Роли)
 - Клиент может авторизовываться только с помощью номера телефона и кода из смс (после ввода номера пользователю уходит смс на номер с кодом). 
   Администратор может авторизоваться через email и password. 

- После успешной авторизации пользователь должен получать токен для дальнейшего взаимодействия с системой.
  По ссылке можно посмотреть структуру бд (https://dbdiagram.io/d/607ed9bab29a09603d115139). 

### Таблицы
- Таблица clients - сущность клиента. 
- Таблица users - сущность администратора.


Отправку смс стоит реализовать через сервис sendPulse(https://sendpulse.ua).

Авторизацию следует реализовывать через laravel/passport. 

Регистрацию реализовывать не нужно. 

Достаточно создать seeder для клиента и администратора.

После выполнения тестового задания прислать ссылку на репозиторий и коллекцию с Postman для проверки.

```sql
Table users {
  id bigint [pk, increment]
  full_name text
  email varchar [unique]
  phone varchar [unique]
  password varchar [null]
  note text [null]
  created_at timestamp
  updated_at timestamp
}

Table clients {
  id bigint [pk, increment]
  full_name text
  email varchar [unique]
  phone varchar [unique]
  password varchar [null]
  birthday timestamp [null]
  address text [null]
  note text [null]
  created_at timestamp
  updated_at timestamp
}

Table sms {
  id bigint
  code integer
  created_at timestamp
  updated_at timestamp
}
```
