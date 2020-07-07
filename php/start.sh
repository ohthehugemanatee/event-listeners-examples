#!/bin/sh

# Starts the PHP events/listeners example.
docker build . -t php-events-listeners
docker run  --rm --user $(id -u):$(id -g) php-events-listeners php /app/custom-eventHandler.php