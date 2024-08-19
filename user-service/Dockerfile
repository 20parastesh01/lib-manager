FROM hub.hamdocker.ir/php:8.3-fpm

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libonig-dev \
    libzip-dev \
    libgd-dev \
    supervisor \
    zip \
    unzip \
    git \
    nano && \
    docker-php-ext-install \
    dom \
    curl \
    mbstring \
    mysqli \
    pdo_mysql \
    zip \
    gd

RUN pecl install redis && docker-php-ext-enable redis

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock ./

RUN composer install --no-scripts --optimize-autoloader

COPY . .

RUN chown -R www-data:www-data /var/www/html

EXPOSE 8000

CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]