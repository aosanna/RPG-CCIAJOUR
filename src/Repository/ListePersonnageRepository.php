<?php

namespace App\Repository;

use App\Core\Database\AccesseurDb;
use PDO;

class ListePersonnageRepository
{
    public function __construct()
    {

        $accesseur = new AccesseurDb();
        $this->pdo = $accesseur->getPdo();
        
    }

    public function getUserById(int $id)
    {
        $req = $this->pdo->prepare("SELECT *
                                    FROM personnage 
                                    WHERE id_joueur = :id_joueur
        ");
        $req->execute([":id_joueur" => $id]);
        $result = $req->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}