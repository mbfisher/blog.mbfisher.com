FROM php:7.2-cli-alpine

RUN apk add --no-cache postgresql-dev && \
    docker-php-ext-install mysqli