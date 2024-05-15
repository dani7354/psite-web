#!/bin/bash

# Run PHPStan
php ../psite-web/app/vendor/bin/phpstan analyse -c ../psite-web/app/phpstan.neon
