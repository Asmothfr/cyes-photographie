<?php

namespace Library;

use PDO;

require_once "config.php";

class Database
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='. DB_HOST . ';dbname=' . DB_NAME .';charset=utf8', DB_USER, DB_PASSWORD);
    }

    public function findAll(string $sqlQuery, $params = []): array
    {
        $dbQuery = $this->db->prepare($sqlQuery);
        $dbQuery->execute($params);
        $dbResult = $dbQuery->fetchAll();
        return $dbResult;
    }
}