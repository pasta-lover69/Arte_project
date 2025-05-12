# Use the official PHP image with Apache
FROM php:8.1-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the project files into the container
COPY . /var/www/html

# Set permissions for the project files
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 for the web server
EXPOSE 80