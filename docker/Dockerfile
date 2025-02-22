# Stage 1: Node build stage
FROM node:20-alpine as node


WORKDIR /app
COPY package*.json ./
COPY resources ./resources
COPY vite.config.js ./
RUN npm install && npm run build

# Stage 2: PHP build stage
FROM php:8.2-apache as php-build


RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip zip git exiftool \
    # && apt-get install -y vim \
    && a2enmod ssl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install PHP extensions
COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions gd pdo_mysql bcmath zip intl opcache exif mbstring

# Custom php configs
COPY /docker/php.ini /usr/local/etc/php/conf.d/custom.ini

# Set application folder as environment variable
ENV APP_HOME /var/www/html
WORKDIR $APP_HOME

# Copy source files
COPY . $APP_HOME

# Install dependencies
RUN cd $APP_HOME && composer install --no-interaction

# Stage 3: Production stage
FROM php:8.2-apache as production


# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Copy PHP extensions from build stage
COPY --from=php-build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=php-build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d
# COPY --from=php-build /usr/local/bin /usr/local/bin

# Enable apache rewrite and SSL
RUN a2enmod rewrite ssl

# Enable apache rewrite
RUN rm /etc/apache2/sites-available/000-default.conf
COPY /docker/sites-available/000-default.conf /etc/apache2/sites-available/
RUN a2enmod rewrite

# Create system user
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set application folder as environment variable
ENV APP_HOME /var/www/html
WORKDIR $APP_HOME

# Copy built application from build stage
COPY --from=php-build $APP_HOME $APP_HOME

# Copy frontend build assets from node-build
COPY --from=node /app/public/build ./public/build

# Set permissions
RUN chmod -R 777 $APP_HOME/storage \
    && chmod -R 777 $APP_HOME/bootstrap/cache

# Clear views
RUN cd $APP_HOME && php artisan view:clear

# Set user
USER root
