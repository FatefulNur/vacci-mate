# Vaccine Registration Application

Vacci-Mate is a vaccine registration application with laravel tasks scheduling feature.

## Installation
Clone the repo
```
    git clone https://github.com/FatefulNur/vacci-mate.git --single-branch -b feature-2
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

## Integration Webhook
You may set up [zapier](https://zapier.com/) webhook to access request from our application. Zapier is a platform where you can communicate between api to api or software to software. Zapier can trigger an event from thousands of services and can take action or pass payload to another service. To integrate zapier:
- Create a google form exactly like our application register form. [example](https://forms.gle/Pdy5HKZp4V2DzmiWA)
- Create a zapier account.
- Create new zap.
- Connect trigger with the created google form.
- Connect webhook action that point to our application endpoint `/webhook/register`.
- Publish zap.

After that whenever someone response to that google form zapier will automatically trigger an action with payload and user will be registered by our application logic.

**NOTE:** Don't forget that zapier cannot trigger an action to localhost. If you want to test that `/webhook/register` endpoint works, you may use ngrok service to turn localhost into a live server.

## Greetings
Thanks for reading.
