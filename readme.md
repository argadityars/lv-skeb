[![N|Solid](http://skebbook.com/img/logo.png)](http://skebbook.com)

Skebbook is an online book marketplace from Indonesia.

### New Features

- User Management
- Shop Management
- Product Management
- Product Preview
- Search/Filter Product

### For Dev

Ddownload or clone this repo
Run composer install
```sh
$ composer install
```
Make sure you have the .env file
```sh
$ cp .env.example .env
```
Generate key for this project
```sh
$ php artisan key:generate
```
Config your database seting in .env file, then run migration command
```sh
$ php artisan migrate
```
You are good to go :D


### Todos

 - Payment system
 - Testing


