# INSTALLATION

You need PHP 7.2

Clone repository:

`git clone https://github.com/pdandreyv/smsedge.git`

Install by composer:

`composer install`

Create .env file in root project folder from .env.example - input datebase connection data

Create all need tables in datebase with default data:

`php artisan migrate`

Generate Numbers data by default 10, but optional parameter [count] create another count numbers data:

`php artisan generate:number_data [count]`

Generate Users data by default 100, but optional parameter [count] create another count users data. Created date will random by 5 last days.

`php artisan generate:user_data [count]`

Aggregate Users data to send_log_aggregated table. In future you can setup this command to cron by every day

`php artisan aggregate:send_log`

This is all enjoy the application.