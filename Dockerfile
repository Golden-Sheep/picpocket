# Usar uma imagem base do PHP com FPM
FROM php:8.3-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libmemcached-dev \
    libz-dev \
    libpq-dev \
    libssl-dev \
    libmcrypt-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    default-mysql-client

# Instalar extensões do PHP
RUN docker-php-ext-install pdo_mysql zip exif pcntl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar a aplicação Laravel
COPY . /var/www

# Instalar dependências do Laravel com Composer
RUN composer install --optimize-autoloader --no-dev

# Dar permissões no diretório
RUN chown -R www-data:www-data /var/www

# Expor a porta 9000
EXPOSE 9000

# Comando de inicialização
CMD ["php-fpm"]
