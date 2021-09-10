<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Repository\AchatVenteRepository;

class VenteController extends AbstractController
{
    public function Vente($id_inventaire){
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
    $repo=new AchatVenteRepository();
    $repo->vente($id_inventaire[0]);
    header("location:../achatvente");
    }
    
}