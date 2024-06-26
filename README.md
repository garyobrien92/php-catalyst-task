# php-catalyst-task

Php task for catalyst IT.

# Prerequisites

For this project you must have php installed and version 8.1.*

# Run Locally

If you have php and mysql installed you can just run scripts like below just make sure you have database created `users_csv_upload`.

# Run Csv User Upload Script

```bash
 cd /php-catalyst
 php user_upload.php --create-table --file="users.csv" -u="test" -p="password" -h="127.0.0.1"
 php user_upload.php --dry-run
 php user_upload.php --help

```

# Run Foobar Script

```bash
 cd /php-catalyst
 php foobar.php
```

# Run with Docker

## Docker Build

This will run script using Docker and you can pass enviroment variables through to script with docker

```bash
    cd /php-catalyst
    docker build -t php-catalyst . --no-cache

    docker image ls
    docker run 83264c49022e
```

### With Vars

#### All build args have defaults

file_name=users.csv
db_user=user
db_password=password
db_host=host.docker.internal

```bash
    cd /php-catalyst
    docker build --build-arg file_name="users.csv" --build-arg db_user="user" --build-arg db_host="host.docker.internal" --build-arg db_password="password" -t php-catalyst --no-cache .
```

## Docker Compose

Docker compose file creates database and calls it `users_csv_upload`. Make sure you have docker compose command installed.

### Compose up

To run docker compose file make sure you have docker compose command installed and run:

```bash
    cd /php-catalyst
    docker compose up
```

### Compose down

To teardown docker containers

```bash
     cd /php-catalyst
    docker compose down
```
