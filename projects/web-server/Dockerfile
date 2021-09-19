# Set the image to PHP 8 + Apache
# https://hub.docker.com/_/php?tab=tags&page=1&ordering=last_updated&name=apache
FROM php:8.0-apache

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy the php.ini into the image
COPY configurations/php.ini /usr/local/etc/php/

# Copy the code into the image
COPY src/ /var/www/html/

# Open port 80
EXPOSE 80