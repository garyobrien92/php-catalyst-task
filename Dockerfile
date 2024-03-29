FROM php:8.1-cli

RUN docker-php-ext-install mysqli

ARG file_name="users.csv"
ARG db_user="user"
ARG db_password="password"
ARG db_host=host.docker.internal

ENV FILE=$file_name
ENV DB_USER=$db_user
ENV DB_PASSWORD=$db_password
ENV DB_HOST=$db_host

WORKDIR /catalyst-task

COPY ./user_upload.php .
COPY ./db.php .
COPY ./users.csv .

CMD php user_upload.php --file=${FILE} --create-table -u=${DB_USER} -p=${DB_PASSWORD} -h=${DB_HOST}