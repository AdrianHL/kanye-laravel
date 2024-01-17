# Kayne West API with Laravel
This project uses Laravel to serve an API around Kayne West quotes using [kayne.rest](https://kanye.rest/).

There are two API endpoints:

* `/api` - which returns 5 quotes from Kayne West. Please note that these are cached once called until refreshed.
* `/api/refresh` - which refresh the 5 quotes from Kayne West. Please note that once hit the next calls to `/api` will return the last refreshed ones until again refreshed.

## Local Setup

This project is dockerized so please make sure that Docker is up and running before setting up this project. More info at [Get Started with Docker](https://www.docker.com/get-started/).

Please follow the next steps to build and run the project. From the project root run:

1. `docker-compose up -d` &larr; This will build and start the containers for you.
2. `docker exec -ti kayne-php /bin/bash -c "composer install"` &larr; This will install the project dependencies.
3. Visit the available routes (`/api` or `/api/refresh`) using a valid token. By default this token is `adrianhl` but it can be updated in `/config/api.php` as needed. Please note that the project is served by default on port 8123; feel free to change this on `docker-compose.yml` if needed. So, as an example visit `http://localhost:8123/api?token=adrianhl`.
4. If you want to run the test please follow the steps on [Tests](#tests).

## Tests

Please setup the application following the [Local Setup steps](#local-setup) before running the tests. Once ready, follow these steps:

1. `docker exec -ti kayne-php /bin/bash -c "php artisan test"` &larr; This triggers the test suite within the container. Please note that all tests, unit and feature, run when using this.

If you want to run specific test suites please do it with:
* Unit &rarr; `docker exec -ti kayne-php /bin/bash -c "php artisan test --testsuite=Unit`
* Feature &rarr; `docker exec -ti kayne-php /bin/bash -c "php artisan test --testsuite=Feature`

## Next Steps

* Get feedback.
