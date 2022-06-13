FROM php:5.6.40-apache

RUN a2enmod headers && docker-php-ext-install pdo pdo_mysql

COPY security.conf /etc/apache2/conf-enabled/security.conf

CMD ["apache2-foreground"]
