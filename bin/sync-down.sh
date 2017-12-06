#!/usr/bin/env bash

set -e

bin/backup.sh

docker-compose exec db mysql -uroot -proot wordpress < backup.sql

docker-compose exec db mysql -uroot -proot wordpress -e "UPDATE wp_options SET option_value='http://localhost' WHERE option_name in ('home', 'siteurl');"