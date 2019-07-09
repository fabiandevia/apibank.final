FROM php:7.1-apache
RUN apt-get -y update
RUN docker-php-ext-install mysql mysqli
