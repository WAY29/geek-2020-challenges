FROM php:7.2-apache

COPY ./html/ /var/www/html/
COPY ./php.ini /usr/local/etc/php/php.ini
RUN chmod 755 -R /var/www/html/ && chown -R www-data:www-data /var/www/html
