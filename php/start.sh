#!/bin/sh

# Starts the PHP events/listeners example.
docker run --rm --volume $PWD:/app --user $(id -u):$(id -g) php php /app/custom-eventHandler.php