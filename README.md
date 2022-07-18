## **SMARTDATA**


## **Prerequisites**

- PHP Web Server (Nginx)
- Postgres Database
- 

## **Installing**

- 1. Copy .env.example to .env (For Linux:  cp .env.example .env ) & .env.example to .env.testing
- 2. i) Install all dependent packages using composer (composer install)
   
- 3. (Linux Only) make write permission on the folder storage, bootstrap/cache, .env
- Steps 4
- _chmod 777 -R storage_
- _chmod 777 -R bootstrap_
- _chmod 777 -R .env_



## database Configuration

Change the memory limit in php.ini file
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=samrtdata
DB_USERNAME=postgres
DB_SCHEMA=public
DB_PASSWORD=9495

- Run php artisan migrate --path=database/migrations/version1

- Run project php artisan serve

