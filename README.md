# Laravel Multi Auth

The Laravel Framework project boilerplate with Inertia setup in vue. It has separate model and guards for both user and admin.


## Run Locally

Clone the project

```bash
git clone https://github.com/itxshakil/multi-auth-for-laravel
```

Go to the project directory

```bash
cd laravel-multi-auth
```

Install dependencies & build assets

```bash
composer install
npm install && npm run dev
```

Migrate and seed database

```bash
php artisan migrate
```

Start the server

```bash
php artisan serve
```


## Running Tests

To run tests, run the following command

```bash
  php artisan test
```


## License

This package inherits the licensing of its parent framework, Laravel, and as such is open-sourced software licensed under the [MIT](https://choosealicense.com/licenses/mit/)