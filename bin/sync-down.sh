#!/usr/bin/env bash

set -e

source bin/env

docker run -i mariadb mysqldump -h$DB_HOST -P$DB_PORT -u$DB_USER -p$DB_PASSWORD $DB_NAME > /tmp/dump.sql

docker-compose exec db mysql -uroot -proot wordpress < /tmp/dump.sql

docker-compose exec db mysql -uroot -proot wordpress -e "UPDATE wp_options SET option_value='http://localhost' WHERE option_name in ('home', 'siteurl');"