FROM node:14-alpine3.13

# Update
RUN apk update
RUN npm install -g npm
RUN npm config set unsafe-perm true

# Use host user (to fix file permission). Required on Linux
ARG UID
USER ${UID}

WORKDIR /var/www/html
