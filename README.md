//step 1  run
composer install

//step 2  setup .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_management
DB_USERNAME=root
DB_PASSWORD=

//step 3 run
php artisan migrate --seed
//NOTE : project_id was added as a migration,be sure to confirm it exists in the table

//step 4 run
php artisan serve

//then open this link in the browser
http://127.0.0.1:8000