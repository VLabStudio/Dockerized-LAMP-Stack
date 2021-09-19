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

    echo '
        <style>
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
    ';

    echo '
        <h2>Users</h2>

        <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Views</th>
        </tr>
    ';

    foreach ($users as &$user) {
        echo '
            <tr>
                <td>' . $user["id"] . '</td>
                <td>' . $user["name"] . '</td>
                <td>' . $user["views"] . '</td>
            </tr>
        ';
    }

    echo '</table>';