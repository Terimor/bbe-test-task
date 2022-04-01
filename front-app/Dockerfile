# build stage
FROM node:14.17 as build-stage
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# production stage
FROM nginx:1.19 as production-stage
COPY --from=build-stage /app/dist /var/www/html
COPY ./etc/nginx /etc/nginx
EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]