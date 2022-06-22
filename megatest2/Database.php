<?php

class database{

    protected PDO $pdo;

    public function __construct()
    {
        $config = include_once "config.php";

        $db = ($config['database']);

        extract($db);

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
}