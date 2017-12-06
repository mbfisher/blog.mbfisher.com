#!/usr/bin/env bash

set -e

source bin/env

docker run -i mariadb mysqldump -h$DB_HOST -P$DB_PORT -u$DB_USER -p$DB_PASSWORD $DB_NAME > backup.sql
