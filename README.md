# ![Wallet App]
# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation)

Clone the repository

    git clone https://github.com/jamtechdev/wallet-app-task.git

Switch to the repo folder

    cd wallet-app-task

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate


Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve
  

## API Specification

> [App listed on postman](https://api.postman.com/collections/19986081-70c4afc8-b341-4373-8f3a-876292d38341?access_key=PMAT-01H8C15DNV4DR1FQV7XAGEDCEM)
