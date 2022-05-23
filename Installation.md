## Step 1 - Clone repository

`git clone https://gitlab.com/tbdevgroup/floraqueen-demo.git`

## Step 2 - Change directory
`cd floraqueen-demo`


## Step 3 - Copy env file
`cp .env.example .env`

## Step 4 - Setup Docker environment

`docker-compose up -d`

## Step 5 - Create Docker Environment

`./vendor/bin/sail up -d`

## Step 6 - Run npm command

`./vendor/bin/sail npm run dev`

## Step 7 - Visit the website

[http://localhost:9050](http://localhost:9050)
