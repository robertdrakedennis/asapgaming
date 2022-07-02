FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
	    git \
	    libcurl4-gnutls-dev \
	    libicu-dev \
	    libmcrypt-dev \
	    libvpx-dev \
	    libjpeg-dev \
	    libpng-dev \
	    libxpm-dev \
	    zlib1g-dev \
	    libfreetype6-dev \
	    libxml2-dev \
	    libexpat1-dev \
	    libbz2-dev \
	    libgmp3-dev \
	    libldap2-dev \
	    unixodbc-dev \
	    libpq-dev \
	    libsqlite3-dev \
	    libaspell-dev \
	    libsnmp-dev \
	    libpcre3-dev \
	    libtidy-dev \
	    software-properties-common \
	    zip unzip\
	    ntfs-3g \
	    cifs-utils \
	    gnupg \
    && docker-php-ext-install mbstring pdo_mysql curl json intl gd xml zip bz2 opcache soap tidy bcmath \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && cd ~ \
    && curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer global require "laravel/envoy=~1.0" \
    && curl -sL https://deb.nodesource.com/setup_8.x | bash - \
    && apt-get install nodejs \
    && npm i -g cross-env

