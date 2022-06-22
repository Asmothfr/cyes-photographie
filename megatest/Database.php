<?php

require_once "config.php";

class Database
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host='. DB_HOST . ';dbname=' . DB_NAME .';charset=utf8', DB_USER, DB_PASSWORD);
    }

    public function findAll($sqlQuery, $neMeDemandezPasCeQueCestJaiPassePlusDeDeuxJourAcomprendJePensesQueVousEtesDesSorcierCeTrucNaPasDeSens = [] ): array
    {
        $dbQuery = $this->db->prepare($sqlQuery);
        $dbQuery->execute($neMeDemandezPasCeQueCestJaiPassePlusDeDeuxJourAcomprendJePensesQueVousEtesDesSorcierCeTrucNaPasDeSens);
        $dbResult = $dbQuery->fetchAll();
        return $dbResult;
    }
}