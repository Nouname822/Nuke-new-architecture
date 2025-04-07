FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpq-dev \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs

RUN npm install -g nodemon

WORKDIR /var/www/app

COPY . .

RUN composer install --no-dev --prefer-dist

RUN chmod +x public/index.php

EXPOSE 8000

CMD ["nodemon", "--exec", "php public/index.php", "--ext", "php"]