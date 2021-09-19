<?php
    $dbHost = getenv("MYSQL_HOST", true) ?: getenv("MYSQL_HOST");
    $dbDatabase = getenv("MYSQL_DATABASE", true) ?: getenv("MYSQL_DATABASE");
    $dbUser = getenv("MYSQL_USER", true) ?: getenv("MYSQL_USER");
    $dbPassword = getenv("MYSQL_PASSWORD", true) ?: getenv("MYSQL_PASSWORD");

    try {
        $DBH = new PDO("mysql:host=$dbHost;dbname=$dbDatabase", $dbUser, $dbPassword);
    } catch (PDOException $ex) {
        die("Error: $ex");
    }

    $statement = $DBH->prepare("SELECT * FROM `users`;");
    $statement->execute();
    $users = $statement->fetchAll();

    foreach ($users as &$user) {
        $views = intval($user["views"]) + 1;

        $statement = $DBH->prepare("UPDATE `users` SET `views` = ? WHERE `users`.`id` = ?;");
        $statement->bindParam(1, $views, PDO::PARAM_INT);
        $statement->bindParam(2, $user["id"], PDO::PARAM_STR);
        $statement->execute();
        
        unset($views);
    }