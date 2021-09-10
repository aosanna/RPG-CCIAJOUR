<?php

namespace App\Repository;

use App\Core\Database\AccesseurDb;
use PDO;

class AchatVenteRepository
{

    public function __construct()
    {
        $dbh = new AccesseurDb();
        $this->pdo = $dbh->getPdo();
    }
    
    // fct qui affiche le menu d'achat vente
    public function DisplayAchat($id_marchant){
        $req = $this->pdo->prepare("SELECT * FROM inventaire 
        INNER JOIN objet on objet.id_objet = inventaire.id_objet
        WHERE id_perso = :id
        ");
        $req->execute([
            ":id" => $id_marchant
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    public function DisplayVente($id_perso){
        $req = $this->pdo->prepare("SELECT * FROM inventaire 
        INNER JOIN objet on objet.id_objet = inventaire.id_objet
        INNER JOIN personnage on personnage.id_perso = inventaire.id_perso
        WHERE inventaire.id_perso = :id
        ");
        $req->execute([
            ":id" => $id_perso
        ]);
        
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function DisplayGold($id_perso){
        $req = $this->pdo->prepare("SELECT * FROM personnage
        WHERE id_perso = :id");
        $req->execute([
            ":id" => $id_perso
        ]);
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

        
    //faire une fonction Achetter
    public function achat($id_perso,$id_objet) :void {
        $req = $this->pdo->prepare("INSERT INTO inventaire (id_perso, id_objet) 
        VALUES (:id_perso, :id_objet)
        ");
        $req->execute([
            ":id_perso"=>$id_perso,
            ":id_objet"=>$id_objet
        ]);
        $req2 = $this->pdo->prepare("UPDATE personnage 
        INNER JOIN inventaire on personnage.id_perso = inventaire.id_perso
        INNER JOIN objet on inventaire.id_objet = objet.id_objet
        SET po = (po - objet.pa)
        WHERE objet.id_objet = :id_objet");
        $req2->execute([
            ":id_objet" => $id_objet
        ]);
    }
    
    //faire fonction Vendre
    public function vente($id_inventaire){
        $req2 = $this->pdo->prepare("UPDATE personnage 
        INNER JOIN inventaire on personnage.id_perso = inventaire.id_perso
        INNER JOIN objet on inventaire.id_objet = objet.id_objet
        SET po = (po + objet.pa/2)
        WHERE inventaire.id_inv = :id");
        $req2->execute([
            ":id" => $id_inventaire
        ]);

        $req = $this->pdo->prepare("DELETE FROM inventaire 
        WHERE id_inv = :id_inventaire");
        $req->execute([
            ":id_inventaire"=>$id_inventaire
        ]);
    }


}
