#!/usr/bin/env bash

cd /var/www/html && sudo docker-compose up -d --build
sudo docker exec btt_php php composer.phar install
[[ ! -d /var/www/html/config/jwt ]] && sudo docker exec btt_php bin/console lexik:jwt:generate-keypair && echo 'Generated keypair for Auth'
sudo docker exec btt_php bin/console --no-interaction doctrine:migrations:migrate