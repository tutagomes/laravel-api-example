# laravel-api-example

https://paiza.cloud/

![image-20200117012913874](assets/image-20200117012913874.png)

Começando:

Abra dois terminais, no primeiro executando:

```
git clone https://github.com/tutagomes/laravel-api-example.git
redis-server
```

E no segundo:

``` 
cd shop
composer install

cd ..
cd shop_interface
npm install -g @quasar/cli
npm install

cd ..
cd micro_produto
composer install

cd ..
cd micro_auth
composer install
php artisan passport:install

cd ..
cd micro_gateway
composer install

cd ..
cd micro_pedido
composer install
```

