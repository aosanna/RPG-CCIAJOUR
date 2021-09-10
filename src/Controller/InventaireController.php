<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Repository\AchatVenteRepository;

class InventaireController extends AbstractController
{

    public function index()
    {
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        $id_perso = $_SESSION["idPerso"];
        $repo=new AchatVenteRepository();
        $this->render("AchatVente.html",[
            "items"=>$repo->DisplayAchat(1),
            "invent"=>$repo->DisplayVente($id_perso),
            "gold"=>$repo->DisplayGold($id_perso)
        ]);
    }
}
