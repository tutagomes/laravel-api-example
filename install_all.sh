cd MicroDia4

cd micro_auth
touch database.sqlite
composer install
php artisan migrate:fresh --seed

cd ..
cd micro_avaliacoes
touch database.sqlite
composer install

cd ..
cd micro_gateway
npm install

cd ..
cd micro_lugares
touch database.sqlite
composer install