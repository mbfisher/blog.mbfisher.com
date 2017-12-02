#!/usr/bin/env bash

heroku config:set $(\
    curl -s https://api.wordpress.org/secret-key/1.1/salt/ | \
    sed -E -e "s/^define\('(.+)', *'(.+)'\);$/WP_\1=\2/" -e 's/ //g' \
)