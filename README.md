Guten Morgen!

Hoje vamos criar templates Blade para demonstrar dados de forma mais visual (sem depender de APIs e interfaces assíncronas) e implementar pequenos testes de unidade e tela utilizando Dusk.

Para começar, vamos criar uma máquina virtual no Paiza Cloud e executar os comandos:
```sh
git clone https://github.com/tutagomes/laravel-api-example.git

cd  laravel-api-example/shop
composer install
php artisan migrate:fresh --seed
php artisan serve --host=0.0.0.0:8000

```
Dessa forma, você pode acessar o endereço disponibilizado e verificar se `/api/pedidos` retorna valores válidos!
