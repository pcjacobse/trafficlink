FROM php:7.0-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng12-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd     

RUN docker-php-ext-install mysqli mbstring pdo_mysql 

# Download and Installing php libraries 
RUN apt-get -y install php-pear php5-dev 

# Download and Installing git and vim 
RUN apt-get -y install git vim gcc

# Download and Installing zip unzip 
RUN apt-get -y install zip unzip 

# install PHP PEAR extensions 
RUN apt-get -y install wget

# Clean up APT when done.
RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 9000
