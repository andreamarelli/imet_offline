FROM node:14-alpine3.13

# Update
RUN apk update
RUN npm install -g npm
RUN npm config set unsafe-perm true

# Use host user (to fix file permission). Required on Linux
ARG UID
USER ${UID}

WORKDIR /var/www/html

#
#FROM node:18-alpine
#
## Update
#RUN apk update
#RUN npm install --unsafe-perm=true -g npm
#
#RUN apk add --no-cache make g++
#
## Install python
#ENV PYTHONUNBUFFERED=1
#RUN apk add --no-cache python3 && ln -sf python3 /usr/bin/python
#RUN python3 -m ensurepip
#RUN pip3 install --no-cache --upgrade pip setuptools
#
## Use host user (to fix file permission). Required on Linux
#ARG UID
#USER ${UID}
#
#WORKDIR /var/www/html
