FROM php:8.0-apache
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip
RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client libmagickwand-dev --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
&& docker-php-ext-install mcrypt pdo_mysql \
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORDIR /
COPY . .
RUN npm install --production
RUN npm run encore dev
CMD ['Symfony']
