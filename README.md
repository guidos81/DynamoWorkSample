# Dynamo Work Sample

Currently only fetches and orders 25 laureates, presenting the most recent 20 laureates.
It uses data from the Nobel Prize open API: https://www.nobelprize.org/about/developer-zone-2/

The number of laureates can be changed from the LaureateService class, where the limit of the API can be extended to 1000 to collect all 981 current laureates.

## Potential Improvements

* Collect the laureates through pagination from the Noble Prize API
* Cache the response from the Noble Prize API to reduce requests
* Store results in a database and use this data to return results. A background job could refresh the database on a set schedule.
* Exception handling around the Noble Prize API request


# Slim Framework 4 Skeleton Application

[![Coverage Status](https://coveralls.io/repos/github/slimphp/Slim-Skeleton/badge.svg?branch=master)](https://coveralls.io/github/slimphp/Slim-Skeleton?branch=master)

Use this skeleton application to quickly setup and start working on a new Slim Framework 4 application. This application uses the latest Slim 4 with Slim PSR-7 implementation and PHP-DI container implementation. It also uses the Monolog logger.

This skeleton application was built for Composer. This makes setting up a new Slim Framework application quick and easy.

## Install the Application

Run this command from the directory in which you want to install your new Slim Framework application. You will require PHP 7.4 or newer.

```bash
composer create-project slim/slim-skeleton [my-app-name]
```

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:

* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` is web writable.

To run the application in development, you can run these commands 

```bash
cd [my-app-name]
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.
