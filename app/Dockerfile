FROM php:8.3-fpm

# Installe les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libzip-dev zip nginx supervisor \
    && docker-php-ext-install intl pdo pdo_mysql

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Dossier de travail
WORKDIR /var/www/symfony

# Copie le code Symfony
COPY symfony/ /var/www/symfony/

# Crée les dossiers de logs et donne les droits
RUN mkdir -p /var/logs/crud \
    && touch /var/logs/crud/app.log /var/logs/crud/access.log /var/logs/crud/error.log \
    && chmod -R 777 /var/logs/crud

# Copie la config Nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Copie la config Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80
CMD ["/usr/bin/supervisord"]
