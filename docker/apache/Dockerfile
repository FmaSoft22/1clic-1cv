FROM php:8.0-apache
RUN apt-get update \
&& apt-get install -y \
&& apt-get autoremove -y \
&& docker-php-ext-install mysqli pdo pdo_mysql \
&& apt-get install curl -y \
&& apt-get install git -y\
&& apt-get install -y wget \
&& apt-get install zip -y\
&& curl -sS https://get.symfony.com/cli/installer | bash \
&& mv /root/.symfony/bin/symfony /usr/local/bin/symfony \
&& wget https://getcomposer.org/download/2.0.9/composer.phar \
 && mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
COPY .  /var/www/html/fma_porfoliosV2_Frontend
COPY ./apache.conf /etc/apache2/sites-enabled/000-default.conf
WORKDIR /var/www/html/fma_porfoliosV2_Frontend
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN chmod +x ./start_server.sh
ENTRYPOINT ["./start_server.sh"]
EXPOSE 8055