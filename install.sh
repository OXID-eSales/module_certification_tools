#!/bin/sh
curl -sS https://getcomposer.org/installer | php -- --install-dir=bin && php bin/composer.phar install

