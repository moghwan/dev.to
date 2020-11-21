---
published: false
title: "Dockerize your Laravel project with Laradock"
cover_image:
description:
tags: Laravel, Laradock, Dockercompose
series:
canonical_url:
---

Hello dear artisans! Todays post I'll try to share my laravel/laradick workflow while using Nginx, and exploring/setting-up two database engines: postgres/mysql, alongside pgadmin, phpmyadmin or adminer, depending your choice.

I'll try to do some extra steps and explain why, and I'll be boring too. I warned you!

## Why Laradock and not docker-compose?

Here's my 2 cent: If you know the basics of docker-compose and want to switch between/quickly add modules with minimum configurations, you should consider using laradock. The only disadvantage using laradock is the long initial build time if you don't have a good download speed.

Before starting you should have Docker installed in your machine. I tested these steps in Windows 10 and Manjaro Linux.

The project will be named laraveldock

## Prepare your virtual host

Open your `hosts` file as super user and add this line:

``` bash
# /etc/hosts (linux)
# C:\Windows\System32\drivers\etc\hosts (Windows)

127.0.0.1 laraveldock.test
```

## Prepare your Laravel Project

If you want to start with a new project open your terminal and install a new laravel project first: 

``` bash
# You can use version 7 or 8
composer create-project --prefer-dist laravel/laravel laraveldock "7.*.*"

cd laraveldock
git init
git add .
git commit -m "init commit"
```
If you already have a project just navigate to it in terminal.

## Installing and Configuring Laradock

Laradock is basically just a git submodule, which means you can use you project without it in any LAMP stack or hosting. Run this git command as below:

``` bash
# module directory should be unique for running multiple Laradock instances
git submodule add https://github.com/Laradock/laradock.git laradock-laraveldock

# go to module dir
cd laradock-laraveldock

# create a .env file from the example
cp env-example .env

# open docker compose config file to add our virtual host
code docker-compose.yml
```

Add the same virtual host url added earlier in `host` file like below:
``` yml
# approximately line 375
nginx:
    # - frontend
    # - backend
    networks:
        frontend:
          aliases:
            - laraveldock.test
        backend:
          aliases:
            - laraveldock.test
```

Why? This is a minor fix when I worked with API calls in a SPA project, Laravel ad Vue combined to be precise. There is an alternative to do with nginx `.conf` files but I prefer this method.

## Building docker images

Just a note before continuing, I'll explain using both database engines (mysql and postgresql), with administration tools such as phpmyadmin, pgadmin and adminer.

Before building the images be sure you're in the laradock directory:

``` bash
cd laradock-laraveldock

# for mysql
docker-compose up -d --build nginx mysql

# for posqtgresql
docker-compose up -d --build nginx postgres
```

Now go prepare another cup of coffee. I'm serious here.

After build is finished you'll see your containers created. Navigate with your browser to [laraveldock.test](laraveldock.test), you should see your homepage.

### Bonus
Navigate to your working directory in your container:

``` bash
docker-compose exec workspace bash
```

Laradock already installed many cli tools for us such as `artisan`, `composer`, `node`, `npm`, `yarn`, `phpunit`, `git` and `vue`.

## Setting up database

In this step I'll use both cli and gui methods for both mysql and postgres.

### Mysql / PhpMyAdmin

First let's build our phpmyadmin container:
``` bash
docker-compose down

docker-compose up -d --build nginx phpmyadmin
```

I Stopped all containers and run them again just to show you that phpmyadmin will automatically start mysql container, if you check `docker-compose.yml` you'll notice that phpmyadmin depends on mysql. Same thing applies to `postgres` and `pgadmin`.

Navigate to phpmyadmin with [laraveldock.test:8081](laraveldock.test:8081) and create your database (***lara_db*** in my case) with these credentials:
- **Hostname**: mysql
- **Username**: root
- **Password**: root

Or with cli as below:

```bash
docker-compose exec mysql bash

  mysql -uroot -proot
  create database lara_db;
  exit

exit
```

### Postgresql / PgAdmin

Build your pgadmin container:
``` bash
docker-compose down

docker-compose up -d --build nginx pgadmin
```

Navigate to pgadmin with [laraveldock.test:5050](laraveldock.test:5050) and login with these credentials:
- **Username** : pgadmin4@pgadmin.org
- **Password** : admin

> If your browser just keeps loading without any response it could be a permission issue, you can fix it by granting write permissions, [more details here](https://github.com/laradock/laradock/issues/2552).

Add a new server with these:
- **Hostname**: postgres
- **Database**: laradock
- **Username**: default
- **Password**: secret

Then create your database **lara_db**.

Or with cli as below:

```bash
docker-compose exec postgres bash

  psql -U default
  create database lara_db;
  exit

exit
```

## Connecting Laravel with Database

Open your project `.env` file - not the one inside laradock submodule disrectory - with your editor and edit these values as shown below:

``` conf
APP_URL=http://laraveldock.test

# for mysql
DB_HOST=mysql
DB_DATABASE=lara_db
DB_USERNAME=root
DB_PASSWORD=root

# for postgresql
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=lara_db
DB_USERNAME=default
DB_PASSWORD=secret
```

You're done! to test it out try to migrate your schemas with artisan:

``` bash
docker-compose exec workspace bash
artisan migrate
```

A quick note: If you're on linux and you don't have permission to edit your project files with your editor you can simply run `chmod -R 777 *`.

Now whenever you want to stop and run you containers you'll use just these two commands:

``` bash
# stop containers
docker-compose stop

# stop containers and remove all networks
docker-compose down

# start myqsl, phpmyadmin and nginx
docker-compose up -d nginx phpmyadmin

# or postgres, pgadmin and nginx
docker-compose up -d nginx pgadmin
```

And voilà!

If you have any recommendation, improvment, found a typo just let me in the comments or fork [this project](github.com/moghwan/dev.to) and make your edits, any contibution is welcome.

Hope you found this article helpful!
