<?php

namespace App\Repository;

use App\Core\DataBase\AccesseurDb;
use App\Entity\User;
use PDO;

class UserRepository extends AccesseurDb
{

    public function __construct()
    {
        $dbh = new AccesseurDb();
        $this->pdo = $dbh->getPdo();
    }
    
    public function addUser(User $user): void
    {
        $req = $this->pdo->prepare("INSERT INTO joueur (pseudo, mdp) VALUES (:pseudo, :mdp)");
        $req->execute([
            ":pseudo" => $user->getPseudo(),
            ":mdp" => $user->getMdp()
        ]);
    }

    public function updateUser(User $user): void
    {
        $req = $this->pdo->prepare("UPDATE joueur AS u
                                    SET pseudo = :pseudo,
                                        mdp = :mdp
                                    WHERE id_joueur = :id_joueur
        ");
        $req->execute([
            ":id_joueur" => $user->getId_joueur(),
            ":pseudo" => $user->getPseudo(),
            ":mdp" => $user->getMdp()
        ]);
    }

    public function deleteUser(int $id): void
    {
        $req = $this->pdo->prepare("DELETE FROM joueur WHERE id_joueur = :id");
        $req->execute(
            [
                ":id" => $id
            ]
        );
    }

    public function findUserByPseudo(string $pseudo)
    {
        $req = $this->pdo->prepare("SELECT * FROM joueur WHERE pseudo = :pseudo");
        $req->execute(
            [
                ":pseudo" => $pseudo
            ]
        );
        $req->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $req->fetch();   
    }
    public function comparaison(string $pseudo)
    {
        $req = $this->pdo->prepare("SELECT * FROM joueur WHERE pseudo = :pseudo");
        $req->execute(
            [
                ":pseudo" => $pseudo
            ]
        );
        return $req->fetchAll(PDO::FETCH_ASSOC);

    }
}