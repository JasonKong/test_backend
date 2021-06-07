# Test Backend app
This app provides few graphQL apis with using laravel as backend framework.
The frontend application can be downloaded from [here].

## Api Features

- Get categories
- Get products
- Get product by category
- Get product by ID
- Create new product
- Update a product
- Delete a product

## Tech

- [GraphQL] 
- [Laravel] 

## Installation

## Project setup
```bash
git clone https://github.com/JasonKong/test_backend.git
cd test_backend
```

1 - Run Composer to install the new requirement.

```sh
$ composer install
```
or update
```sh
$ composer update
```
2 - Create file .env from .env.example and update the database settings

3 - Run artisan migrate and seeder
```sh
$ php artisan migrate
$ php artisan db:seed
```

4 - Serve application
```sh
$ php artisan serve
```
## Testing

```sh
$ vendor/bin/phpunit tests/Unit/ProductTest.php 
```


## Author

Jason Kong

   [GraphQL]: <https://graphql.org/learn/>
   [Laravel]: <https://laravel.com/>
   [here]:<https://github.com/JasonKong/test_frontend.git>
