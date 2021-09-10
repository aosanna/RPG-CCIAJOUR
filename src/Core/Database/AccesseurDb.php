<?php

namespace App\Core\Database;

use PDO;

class AccesseurDb 
{

    public function __construct()
    {
        
    }




    /**
     * Get the value of pdo
     */ 
    public function getPdo()
    {
        return new PDO(
            "mysql:host=localhost;dbname=rpg-cci;charset=UTF8",
            "root",
            "", 
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    /**
     * Set the value of pdo
     *
     * @return  self
     */ 
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;

        return $this;
    }
}