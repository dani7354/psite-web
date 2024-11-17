# psite-web

This repository contains my personal website written in PHP.

## Start development webserver
1. Install PHP, composer and MySQL. Use Docker for running MySQL, see the [psite repo](https://github.com/dani7354/psite)
2. Install composer requirements and generate autoload: \
`$ composer -d ./psite-web/app install`
3. Set the follwing environment variables: \
`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`
4. Start PHP development webserver from public `html` folder \
`$ cd ./psite-web/app/html && php -S localhost:8000`


## Build custom Bootstrap CSS with Sass
1. Make sure that Sass is installed.
2. `$ sass psite-web/custom_scss/custom.scss:psite-web/app/html/assets/css/bootstrap_custom.css`
