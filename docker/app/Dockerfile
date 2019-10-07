FROM php:7.2-fpm-alpine

LABEL maintainer "Edulabzz"

RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/community" >> /etc/apk/repositories

RUN apk update && apk --no-cache add \
   build-base \
   git \
   shadow \
   icu-dev \
   libzip-dev \
   freetype \
   libpng \
   libjpeg-turbo \
   freetype-dev \
   libpng-dev \
   libjpeg-turbo-dev \
   zip \
   nodejs \
   npm \
   g++
RUN docker-php-ext-configure gd \
   --with-gd \
   --with-freetype-dir=/usr/include/ \
   --with-png-dir=/usr/include/ \
   --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install \
   pdo_mysql \
   mysqli \
   zip \
   intl \
   gd

# Copy composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files (Files are changed between builds so docker cache won't be used for subsequent layers)
COPY . /opt/jpiaget
WORKDIR /opt/jpiaget

EXPOSE 80

CMD /opt/jpiaget/docker/app/start.sh