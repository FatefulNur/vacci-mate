# Vaccine Registration Application

Vacci-Mate is a vaccine registration application with laravel tasks scheduling feature.

## Installation
Clone the repo
```
    git clone https://github.com/FatefulNur/vacci-mate.git --single-branch -b feature-1
```

## Usage

Follow the instructions
- Open terminal and run `cd vacci-mate` command.
- Run `composer install` on your cmd or terminal.
- Copy `.env.example` file to `.env`.
- Change your `.env` file with:
    - `APP_NAME="Vacci Mate"`.
    - `APP_TIMEZONE=Asia/Dhaka`.
    - `DB_DATABASE=vacci_mate`.
    - `QUEUE_CONNECTION=database`.
    - Rest of set by your own.
- Run `php artisan key:generate`.
- Run `php artisan migrate`.
- Run `npm run dev` or `npm run build`.
- Run `php artisan serve`.
- Go to http://localhost:8000/register for registration.

## Accessing Panel

To access filament admin panel 
- Visit http://localhost:8000/admin.
- Login credentials:
    - email: `admin@test.com`.
    - password: `password`.

## Mail Configuration
You can use **mailtrap** to set your email configuration testing email in this application. [Here](https://mailtrap.io/blog/send-email-in-laravel/) is the guideline of how to configure mailtrap for laravel.
After set you email server, you are now ready to test email.

## Important
Run the following commands:
- `php artisan db:seed --class=DataSeeder`.
- `php artisan schedule:work` or `php artisan schedule:test`. 
- `php artisan queue:work -v`.

**NOTE:** If you are using [mailtrap](https://mailtrap.io/) without subscription, Then don't run `php artisan db:seed` or `php artisan migrate:fresh --seed`. Cause it seeds from DatabaseSeeder class with massive portion of data. And when you run schedule command, it's may throw <mark>550 5.7.0 Too many emails per second</mark> error. Instead you should use `php artisan db:seed --class=DataSeeder`.

## Greetings
Thanks for reading.
