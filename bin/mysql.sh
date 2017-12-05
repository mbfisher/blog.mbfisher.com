#!/usr/bin/env bash

set -e

source bin/env

if [ -t 0 ]; then
    # Terminal input (keyboard) - interactive
    DOCKER_ARGS="-it"
else
    # File or pipe input - non-interactive
    DOCKER_ARGS="-i"
fi

docker run $DOCKER_ARGS mariadb mysql -h$DB_HOST -P$DB_PORT -u$DB_USER -p$DB_PASSWORD $DB_NAME "$@"
