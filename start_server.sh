#!/usr/bin/env bash
 
composer update
php bin/console doc:mig:mig --no-interaction
php bin/console doc:fix:load --no-interaction
 
exec "$@"