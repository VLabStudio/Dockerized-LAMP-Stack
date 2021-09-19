# Set the image to PHP 8 CLI
# https://hub.docker.com/_/php?tab=tags&page=1&ordering=last_updated&name=apache
FROM php:8.0-cli

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy the php.ini into the image
COPY configurations/php.ini /usr/local/etc/php/

# Copy the code into the image
COPY src/ /usr/src/

# Set the workdir
WORKDIR /usr/src/

# Run the PHP script
CMD [ "php", "./script.php" ]
