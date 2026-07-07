FROM php:8.2-fpm-alpine

# Installer les dépendances système requises pour les extensions PHP
RUN apk add --no-cache \
    nginx \
    supervisor \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    sqlite-dev

# Configurer et installer les extensions PHP nécessaires
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurer le répertoire de travail
WORKDIR /var/www

# Copier tous les fichiers du projet dans le conteneur
COPY . .

# Installer les dépendances Laravel de production
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Créer le fichier SQLite s'il n'existe pas et appliquer les permissions d'écriture
RUN touch database/database.sqlite \
    && chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache /var/www/database

# Vider et optimiser les caches de Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Configurer Nginx et Supervisor
COPY .docker/nginx.conf /etc/nginx/nginx.conf
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
