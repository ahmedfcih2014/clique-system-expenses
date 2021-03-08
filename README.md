## About
this repo for a technical test at <a href="https://1cliquesystems.com/">1 Clique Systems</a>

## Project Dependencies
- PHP 7.3^
- MySQL
- Composer

## Project Install Steps
- create your own DB on your MySQL Server
- run composer install on your project root directory
- copy .env.example to .env file and set DB_DATABASE to your own db_name
- open storage folder and make sure its contains 3 folders with those names (app ,logs & framework) or create them
- open framework folder and make sure its contains 3 folders with those names (cache ,sessions ,views) or create them
- hint : You most run seeder to check the app in a browser (there is no way to create any type of user without seeder)
- now run those commands in root project
- *** php artisan key:generate
- *** php artisan migrate --seed
- *** php artisan storage:link

## Helpful Hints
- api collection & api documentation in the project root folder
- make sure you always refresh DB test to make sure there is conflict in data we use static ids for some resources so please refresh it each time you want to run tests

## Testing
please follow those steps to run automation tests
- update or create .env.testing file and set your own DB test name to make sure you test env is separated from production one
- run this command :
- *** php artisan --env=testing migrate:refresh && php artisan --env=testing db:seed --class=FillTestDB
- now you can run our unit tests
- *** php artisan test --testsuite=Unit // for testing our expense repository functions
- *** php artisan test --testsuite=Feature // for testing our expense apis
