FROM php:7.2-apache

COPY ./flag /flllaggggggggg_isssssssssss_heeeeeeeeeere
COPY ./html/ /var/www/html/
COPY ./run.sh /run.sh
#COPY ./sources.list /etc/apt/sources.list
RUN chmod 755 -R /var/www/html/ && chown -R www-data:www-data /var/www/html

RUN apt-get update && \
    apt-get install -y cron zlib1g-dev libzip-dev \
    && apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && docker-php-ext-install zip \
    && mv /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini \
    && echo "*/5 * * * * root rm /var/www/html/assets/img/upload/*" >> /etc/crontab \
    && chmod +x /run.sh

CMD /run.sh