# Dynamo Work Sample

Currently only fetches and orders 50 laureates, presenting the most recent 20 laureates.
It uses data from the Nobel Prize open API: https://www.nobelprize.org/about/developer-zone-2/

The number of laureates can be changed in the `LaureateService` class, where the limit of the API can be extended to 1000 to collect all 981 current laureates.

## Install the app

In order to run the app you must first clone the app, checkout the `dynamo` branch and install the dependencies:

```bash
git clone git@github.com:guidos81/DynamoWorkSample.git
cd DynamoWorkSample
git checkout dynamo
composer install
```

## Usage

To run the application in development, you can run these commands

```bash
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
docker-compose up -d
```
After that, open `http://localhost:8080/laureates` in your browser.

## Testing

Run this command in the application directory to run the test suite

```bash
composer test
```

## Potential Improvements

* Collect the laureates through pagination from the Noble Prize API
* Cache the response from the Noble Prize API to reduce requests
* Store results in a database and use this data to return results. A background job could refresh the database on a set schedule.
* Exception handling around the Noble Prize API request
* Further abstractions rather than concrete dependencies
* Allow null data in `Laureate` class, currently using defaults for `awardedDate` and `nativeCountry`, add tests for this
* Add test for multiple Noble Prizes. Logic added but untested.
* Allow further parameters to determine number of returned Laureates, pagination?
