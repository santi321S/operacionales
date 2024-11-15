FROM php:8.3-fpm

WORKDIR /var/www/html

COPY . .

RUN apt-get update && \
    apt-get install -y nginx sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo pdo_sqlite

EXPOSE 9000

CMD ["php-fpm"]

