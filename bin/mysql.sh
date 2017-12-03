#!/usr/bin/env bash

source bin/env
docker run -it mariadb mysql -h$DB_HOST -u$DB_USER -p$DB_PASSWORD $DB_NAME
