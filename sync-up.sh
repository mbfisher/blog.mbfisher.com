#!/usr/bin/env bash

set -e

source bin/env

MYSQL=mysql -h$DB_HOST -u$DB_USER -p$DB_PASSWORD $DB_NAME

docker-compose exec db mysqldump -uroot -proot wordpress | docker run -i mariadb $MYSQL

docker run mariadb $MYSQL -e 'UPDATE wp_options SET option_value="https://thefishersblog.herokuapp.com" WHERE option_value in ("home", "siteurl");'

