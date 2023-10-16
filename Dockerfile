# Use the official PHP 8.1 Apache image as the base image
FROM php:8.1-apache

# Set the working directory in the container (Contains the composer.json file)
WORKDIR /var/www/html/

# Enable Apache modules
RUN a2enmod rewrite

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath xml zip intl mysqli

# Install Composer (PHP package manager)
RUN curl -sS https://getcomposer.org/installer | php --  --install-dir=/usr/local/bin --filename=composer

# Copy the application files to the container
COPY . /var/www/html/

# Install dependencies using Composer
RUN composer install

# Laravel ################################
# Generate application key
ADD .env.example .env
RUN php artisan key:generate

# Misc. ##################################
# Expose port 80 to access the web server
# EXPOSE 80

# Install Vim (editor)
RUN apt install vim -y

# Setting file permissions to run Laravel
RUN chown -R www-data:www-data /var/www/html/
# RUN chmod +x /var/www/html/entrypoint/script.sh

# ENTRYPOINT ["/var/www/html/entrypoint/script.sh"]
