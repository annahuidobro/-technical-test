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
By default:
```
$ composer run-script run-technical-test
```

Execute commands with custom parameters:
```
$ php artisan run-technical-test --initial_orientation=N --rectangle_width=4 --rectangle_height=4 --initial_x=2 --initial_y=2 --commands=ARARARAR
```

1.2 With Postman

![POST](public/img/post.png "POST") api/apilaunch

Postman Collection: technical-test.postman_collection.json

Param | Type | Description
------- | ---------------- | :----------
initial_orientation  | `string` | Initial orientation of the Rover. Available orienations: N, E, S, W.
initial_x  | `integer` | Initial X position.
initial_y  | `integer` | Initial Y position.
rectangle_width  | `integer` | Rectangle width size.
rectangle_height  | `integer` | Rectangle height size.
commands  | `string` | Commands to move Rover. Available commands: A, L, R.


200 OK
````json
{
    "success": true,
    "final_orientation": "N",
    "initialX": 2,
    "initialY": 2,
    "rectangleWidth": 4,
    "rectangleHeight": 4,
    "commands": [
        "A",
        "R",
        "A",
        "R",
        "A",
        "R",
        "A",
        "R"
    ],
    "final_position": {
        "x": 2,
        "y": 2
    },
    "steps": [
        {
            "x": 2,
            "y": 2
        },
        {
            "x": 3,
            "y": 2
        },
        {
            "x": 3,
            "y": 3
        },
        {
            "x": 2,
            "y": 3
        },
        {
            "x": 2,
            "y": 2
        }
    ]
}
````

1.3 With web
```
$ php artisan serve
```

Navigate to http://127.0.0.1:8000

