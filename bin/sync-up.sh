#!/usr/bin/env bash

set -e

source bin/env

docker-compose exec db mysqldump -uroot -proot wordpress > /tmp/dump.sql

bin/mysql.sh < /tmp/dump.sql

bin/mysql.sh -e "UPDATE wp_options SET option_value='https://thefishersblog.herokuapp.com' WHERE option_name in ('home', 'siteurl');"