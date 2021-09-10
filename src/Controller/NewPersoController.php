<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Entity\Personnage;
use App\Repository\PersonnageRepository;

class NewPersoController extends AbstractController
{
    
    public function FormNewPerso ()
    {
        if (!$this->checkSecure()){
            header('Location: ConnectionRender');
          }
        $this->render('FormNewPerso.html', [], true, false);
    }
    public function NewPerso ()
    {
        if (!$this->checkSecure()){
            header('Location: ConnectionRender');
          }

        $NewPersonnageValue = $_POST;
        

        $NewPersonnageBdd = new PersonnageRepository();
        
        $NewPersonnage = new Personnage();

        if($NewPersonnageValue['Sexe'] === 'Masculin'){
            $NewPersonnage->setSexe(0);
        }else{
            $NewPersonnage->setSexe(1);
        }

        if ($NewPersonnageValue['Race'] === 'Humain'){
            $NewPersonnage->setRace(1);
        }else if ($NewPersonnageValue['Race'] === 'Elfe') {
            $NewPersonnage->setRace(2);
        }else{
            $NewPersonnage->setRace(3);
        }
        //$NewPersonnage->setRace($NewPersonnageValue['Race']);
        if ($NewPersonnageValue['Class'] === 'Guerrier'){
            $NewPersonnage->setClasse(1);
        }else if ($NewPersonnageValue['Class'] === 'Archer') {
            $NewPersonnage->setClasse(2);
        }else{
            $NewPersonnage->setClasse(3);
        }
        //$NewPersonnage->setClasse($NewPersonnageValue['Class']);
        $NewPersonnage->setNom($NewPersonnageValue['Nom']);
        $NewPersonnage->setLevel(1);
        $NewPersonnage->setPM(100);
        $NewPersonnage->setPV(100);
        $NewPersonnage->setForce(100);
        $NewPersonnage->setAgi(100);
        $NewPersonnage->setInt(100);
        
        $NewPersonnage->setId_joueur($_SESSION['IdUser']);
        
        
        $NewPersonnageBdd->addPersonnage($NewPersonnage);
        $NewPersonnageBdd->updatePersonnage($NewPersonnage);
        header('Location: moncompte');
    }
}