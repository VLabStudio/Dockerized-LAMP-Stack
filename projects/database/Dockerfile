# Set the image to MariaDB
FROM mariadb:10.5

# Setup default variables
ENV MYSQL_ALLOW_EMPTY_PASSWORD=true
ENV MYSQL_DATABASE=project

# Copy the scripts into the image
COPY scripts/ /docker-entrypoint-initdb.d/