FROM php:7.2-fpm

RUN apt-get update && apt-get install -y git nano wget gnupg libpng-dev libicu-dev unzip g++ --no-install-recommends

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -

RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y nodejs yarn --no-install-recommends

RUN apt-get install -y xvfb openssl build-essential libssl-dev libfontconfig

RUN docker-php-ext-install pdo pdo_mysql zip bcmath gd exif opcache calendar intl fileinfo
RUN pecl install xdebug-2.6.1 apcu && docker-php-ext-enable xdebug opcache calendar zip intl fileinfo apcu

RUN wget https://getcomposer.org/composer.phar && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
RUN wget https://phar.phpunit.de/phpunit-5.7.21.phar && chmod +x phpunit-5.7.21.phar && mv phpunit-5.7.21.phar /usr/local/bin/phpunit && phpunit --version

WORKDIR /var/www/html
COPY ./xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./php.ini /usr/local/etc/php/php.ini
