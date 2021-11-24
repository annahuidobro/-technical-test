## How to install

1. Install dependencies
```
$ composer install
```

2. Set permissions
```
$ sudo chmod -R 777 storage/
```

3. Copy .env.example
```
$ cp .env.example .env
```

4. Generate key
```
$ php artisan key:generate
```

## Run de project

1.1 With composer
```
$ composer run-script run-technical-test
```

1.2 With Postman

![POST](public/img/post.png "POST") api/v1/login

Param | Type | Description
------- | ---------------- | :----------
email  | `string` | Email of user.
password  | `string` | Password.

200 OK
````json
{
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9",
    "user_id": 1,
    "token_type": "bearer"
}
````

1.3 With web
```
$ php artisan serve
```

Navigate to http://127.0.0.1:8000

