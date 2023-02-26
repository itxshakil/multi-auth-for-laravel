# Laravel Multi Auth

The Laravel Framework project boilerplate with Inertia setup in vue. It has separate model and guards for both user and admin.

## What is Multi-Authentication?
When I use the term multi-authentication, I want to clarify I am talking about authenticating against multiple user models. It is important to note that these are different user models and not just user roles. User roles can be achieved in a much simpler and less invasive process than what ed did here. We are authenticating against 2 (or more) different User models.

An example of this would be an e-commerce application. You have customers that have a login to your system and you store their information in the database. You process their orders, store their order history, and payment tokens (because storing payment info directly would be sketchy…), manage their wishlists, and more. Customers need to be able to log in to store and manage this data and will have profile pages. On the other hand, you also have company's employee that need to log into another type of backend which allows them to manage products, refund orders, update shipping information, add coupons, and more. These are two entirely exclusive types of users. User roles would not work very elegantly in this situation because there are entirely different backends views/controllers, routes, and middleware between the two user types. In addition, it wouldn’t make sense to share the same database table for these two different types of users because they are so different. Employee users will have database relationships with content that customers need no part in, and vice versa. This is a scenario when managing two different user models makes sense, Employees and Customers.

It is inspired by Article by [Dev Marketer](https://devmarketer.io/learn/setting-multi-authentication-laravel-5-4-part-1/)


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
