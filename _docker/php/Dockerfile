FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
curl \
wget \
git \
libfreetype6-dev \
libjpeg62-turbo-dev \
libxslt-dev \
libicu-dev \
libmcrypt-dev \
libxml2-dev \
libzip-dev \
libpq-dev
#RUN docker-php-ext-install -j$(nproc) iconv mcrypt mbstring mysqli pdo_mysql zip \
#&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
#&& docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install gd
RUN docker-php-ext-install pgsql pdo_pgsql
RUN docker-php-ext-install xsl
RUN docker-php-ext-install soap

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

COPY ./_docker/php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www

RUN chmod -R 0777 /var/www

CMD ["php-fpm"]
