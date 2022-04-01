#!/usr/bin/env bash

cd /var/www/html && sudo docker-compose up -d --build
sudo docker exec btt_php php composer.phar install
sudo docker exec btt_php bin/console lexik:jwt:generate-keypair
sudo docker exec btt_php bin/console --no-interaction doctrine:migrations:migrate
