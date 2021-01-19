# LARAVEL

## Start Development

Setup project for the first time
```
git clone https://github.com/drivedemon/laravel-loan.git
```
Create `.env` file
```
cp .env.example .env
```
Access `env` file then change `API and Database` key
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD="YOUR_PASSWORD_DB"
```
Install Dependencies
```
composer install
```
Migrate Data
```
php artisan migrate
```
Start backend server (You should see the backend up and running on  `localhost:8000`)
```
php artisan serve
```
