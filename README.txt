1. docker compose build
2. docker-compose up -d

Si problème avec le container mysql, retirer cette ligne du docker-compose.yml :

MYSQL_USER: root
MYSQL_PASSWORD: root