#!/usr/bin/env bash

set -e

export $(heroku config -s | xargs)
DB_PORT=${DB_HOST#*:}
DB_HOST=${DB_HOST%:*}

docker-compose up -d

#sleep 10

#docker run mariadb mysqldump -h$DB_HOST -P$DB_PORT -u$DB_USER -p$DB_PASSWORD $DB_NAME | \
#    docker-compose exec -T db mysql -uroot -proot