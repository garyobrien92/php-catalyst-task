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

## Docker Compose
Docker compose file creates database and calls it `users_csv_upload`. Make sure you have docker compose command installed.

### Compose up
To run docker compose file make sure you have docker compose command installed and run:
```
    docker compose up
 ```

### Compose down
To teardown docker containers
 ```
    docker compose down
 ```

