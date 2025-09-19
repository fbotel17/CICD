FROM php:8.3-cli

# Installer extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev mariadb-client \
 && docker-php-ext-install pdo pdo_mysql intl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/symfony

# Commande par défaut : démarrer le serveur interne Symfony
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]

