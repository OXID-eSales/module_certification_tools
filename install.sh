#!/bin/sh

# This file is part of the OXID module certification tool licensed under GPLv3 (http://www.gnu.org/licenses)
# @copyright (C) OXID eSales AG 2003-2014

curl -sS https://getcomposer.org/installer | php -- --install-dir=bin && php bin/composer.phar install

