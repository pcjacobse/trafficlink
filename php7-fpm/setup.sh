#!/bin/bash

pushd /code

rm -Rf /code/{vendor,composer.lock,composer.phar}
curl -sS https://getcomposer.org/installer | php
php composer.phar install

popd

php-fpm
