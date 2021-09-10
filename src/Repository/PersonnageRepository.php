<?php 

namespace App\Repository;

use App\Core\Database\AccesseurDb;
use App\Entity\Personnage;
use PDO;

class PersonnageRepository 
{
    public function __construct()
    {

        $accesseur = new AccesseurDb();
        $this->pdo = $accesseur->getPdo();
        
    }
    
    public function addPersonnage(Personnage $Personnage): void
    {

        $req = $this->pdo->prepare("INSERT INTO personnage (sexe,
                                                            id_race,
                                                            id_classe,
                                                            id_joueur,
                                                            nom, 
                                                            niveau, 
                                                            pv, 
                                                            pm,
                                                            intel,
                                                            forc, 
                                                            agi
                                                            ) 
                                                            VALUES (:sexe, 
                                                                    :id_race, 
                                                                    :id_classe, 
                                                                    :id_joueur, 
                                                                    :nom, 
                                                                    :niveau, 
                                                                    :pv, 
                                                                    :pm,
                                                                    :intel, 
                                                                    :forc,
                                                                    :agi 
                                                                    )");
        $req->execute([
            ":sexe" => $Personnage->getSexe(),
            ":id_race" => $Personnage->getRace(),
            ":id_classe" => $Personnage->getClasse(),
            ":id_joueur" => $Personnage->getId_joueur(),
            ":nom" => $Personnage->getNom(),
            ":niveau" => $Personnage->getLevel(),
            ":pv" => $Personnage->getPV(),
            ":pm" => $Personnage->getPM(),
            ":intel" => $Personnage->getInt(),
            ":forc" => $Personnage->getForce(),
            ":agi" => $Personnage->getAgi()
            
        ]);
    }


    public function updatePersonnage(Personnage $Personnage)
    {
        $req = $this->pdo->prepare("UPDATE personnage
                                        INNER JOIN classe 
                                        ON  classe.id_classe = personnage.id_classe
                                        INNER JOIN race 
                                        ON  race.id_race = personnage.id_race
                                    SET pv = :pv * coef_pv * ratio_pv,
                                        pm = :pm * coef_pm * ratio_pm,
                                        intel = :intel * coef_intel * ratio_intel,
                                        forc = :forc * coef_force * ratio_force,
                                        agi = :agi * coef_agi * ratio_agi
                                        
                                        WHERE id_joueur = :id_joueur
        ");
        $req->execute([
            ":id_joueur" => $Personnage->getId_joueur(),
            ":pv" => $Personnage->getPV(),
            ":pm" => $Personnage->getPM(),
            ":intel" => $Personnage->getInt(),
            ":forc" => $Personnage->getInt(),
            ":agi" => $Personnage->getAgi()
        ]);
       return $req->fetch(PDO::FETCH_ASSOC);
    }

}
