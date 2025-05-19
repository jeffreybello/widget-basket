FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    unzip zip curl git \
    && docker-php-ext-install bcmath

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD ["php", "-S", "0.0.0.0:80", "-t", "."]
