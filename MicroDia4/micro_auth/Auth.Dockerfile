#
# PHP Dependencies
#
FROM composer:1.7 as vendor

COPY database/ database/

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

#
# Application
#
FROM php:7.2-apache-stretch

COPY . /var/www/html
COPY --from=vendor /app/vendor/ /var/www/html/vendor/
WORKDIR /var/www/html
ENV DB_DATABASE /var/www/html/database.sqlite
#Remove banco se existir
RUN rm database.sqlite || true
#Adiciona banco
RUN touch database.sqlite

RUN php artisan migrate:fresh --seed --force

RUN php artisan passport:install

#change uid and gid of apache to docker user uid/gid
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to laravel /var/www/html/public folder
RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf

# enable apache module rewrite
RUN a2enmod rewrite

#change ownership of our applications
RUN chown -R www-data:www-data /var/www/html