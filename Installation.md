## Step 1 - Clone repository

`git clone https://github.com/RazinTeqB/vueLaravelDemo.git`

## Step 2 - Change directory

`cd floraqueen-demo`

## Step 3 - Copy env file

`cp .env.example .env`

## Step 4 - Setup Docker environment

`docker-compose up -d`

## Step 5 - Login into docker ssh

`docker exec -it vuelaraveldemo_laravel.test_1 bash`

## Step 6 - Install composer dependencies

`composer install`

## Step 7 - Generate APP_KEY

`php artisan key:generate`

## Step 8 - Install node dependencies

`npm install`

## Step 9 - Build node dependencies

`npm run dev`

## Step 10 - Visit the website

[http://localhost:9050](http://localhost:9050)
