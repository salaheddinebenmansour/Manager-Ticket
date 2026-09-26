FROM php:8.2-apache

# MySQL driver for PDO
RUN docker-php-ext-install pdo_mysql

# Apache: rewrite module, quiet ServerName, and pass container env vars to PHP
RUN a2enmod rewrite \
    && { \
        echo 'ServerName localhost'; \
        echo 'PassEnv DB_HOST DB_NAME DB_USER DB_PASS BASE_URL'; \
    } > /etc/apache2/conf-available/ticket-manager.conf \
    && a2enconf ticket-manager

# Allow reasonably sized resolution PDFs
RUN { \
        echo 'upload_max_filesize = 16M'; \
        echo 'post_max_size = 16M'; \
    } > /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html
COPY . /var/www/html

RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html/uploads

EXPOSE 80
