Laravel (PHP7) web application for small retail companies.

# Prerequisites

- composer (https://getcomposer.org)
- a web server (Apache or Nginx)
- PHP (v7)
- a database

# How to install

Open your DBMS and create a user and database.
Clone this project.
Create a ".env" file in project's root folder. There is an example: .env.example.
Open a terminal and go to the project folder. Run:
- composer install
- php artisan key:generate
- php artisan migrate --seed

Configure your web server. Create a virtual host and point it to the public folder of the application (some path/easy-shop/public). Then you need to configure your OS to redirect the domain name to the localhost.
You can login with user "admin@admin.com" and password "admin".

# About this application

The app is not finished and I do not recommend to use it in production. I will develop this app to show my skills as a programmer. I also pretend to gain experience with the Laravel framework.
