FROM php:7.0-fpm

ENV PHPREDIS_VERSION php7

RUN docker-php-source extract \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar xfz /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && docker-php-source delete

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

# install Cron
RUN apt-get -y install supervisor cron

# Clean up APT when done.
RUN apt-get autoremove \
    && apt-get autoclean \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

ADD supervisord.conf /etc/supervisor/conf.d/cron.conf
ADD crontab /etc/cron.d/update

RUN echo 'date.timezone = "Europe/Amsterdam"' > /usr/local/etc/php/conf.d/time.ini

ADD setup.sh /
RUN chmod +x /setup.sh

EXPOSE 9000

CMD ["/setup.sh"]