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
- open storage folder and create 3 folders in it with those names (app ,logs & framework)
- open framework folder and create 3 folders in it with those names (cache ,sessions ,views)
- hint : You most run seeder to check the app in a browser (there is no way to create any type of user without seeder)
- now run those commands in root project
- *** php artisan key:generate
- *** php artisan migrate --seed
- *** php artisan storage:link