# Project setup
### Requirements: VM + Vagrant installed

1. vagrant up
2. Accessible -> 192.168.33.34

FE code in this case do not support hot reload

In order to run FE in dev mode with hot reload support:
cd ./front-app  
npm install  
npm run dev  


## Alternative way
### If you don't have/don't want to install requirements mentioned in first approach, you can simply use docker + docker-compose

In order to setup project:
Open docker-compose.yaml and change to nginx host port from 80 to another one available(e.g. 8000)

---
Run commands step by step:  
cd <project_dir> && docker-compose up -d  
docker exec btt_php php composer.phar install  
docker exec btt_php bin/console lexik:jwt:generate-keypair  
docker exec btt_php bin/console --no-interaction doctrine:migrations:migrate

FE code in this case do not support hot reload

Initially you need to set localhost:<port_you_set_in_docker_compose> instead of 192.168.33.34 in ./front-app/vite.config.js

In order to run FE in dev mode with hot reload support:
cd ./front-app  
npm install  
npm run dev  
