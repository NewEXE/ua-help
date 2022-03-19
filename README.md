## Deploying project on server

This project created with `Laravel 9.5.1`
1) Clone git repository.
2) Open terminal in destination path root.
3) Install composer dependencies:
```shell
composer install
```
4) Make copy of `.env.example` to `.env` file:
```shell
cp .env.example .env
```
5) Set the key that Laravel will use when doing encryption:
```shell
php artisan key:generate
```
6) Run NPM build:
```shell
npm install
npm run prod
```
