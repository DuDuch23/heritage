<?php

$dbHost = getenv('DB_HOST'); // Ceci devrait maintenant être 'mysql'
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');  // Vérifiez que vous utilisez 'DB_USER' et non 'DB_USERNAME'
$dbPassword = getenv('DB_PASSWORD');

$pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPassword);