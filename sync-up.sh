#!/usr/bin/env bash

set -e

source bin/env

cat $1 | docker run -i mariadb mysql -h$DB_HOST -u$DB_USER -p$DB_PASSWORD $DB_NAME
