<?php

class Model extends Database
{
    public function getListPhoto(): array
    {
        $sqlQuery = "SELECT * FROM photos";
        return $this->findAll($sqlQuery);
    }
}