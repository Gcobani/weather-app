<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## How to run

To run the project you will need to install [composer](https://getcomposer.org/download/), please follow the instructions for your respective OS.
After cloning this repo `cd` inside the repo and run the following commands 
* `composer install`
* `npm install`\
This will install all the needed dependencies, now copy the `example.env` file contents to a new `.env` file and run `php artisan key:generate` to generate the application key \
You can now run `php artisan serve` to run the dev server, in a separate commandline tab run `npm run dev`\
To run the test, in the root of the directory run `./vendor/bin/phpunit`

