<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Repository\AchatVenteRepository;


class AchatController extends AbstractController
{
    public function Achat($id_objet){

        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
    
    $id_perso = $_SESSION["idPerso"];
    
    $repo=new AchatVenteRepository();
    $gold = $repo->DisplayGold($id_perso);
    $items = $repo->DisplayAchat(1);
    $items= array_combine(range(1, count($items)), array_values($items));
    if($gold[0]["po"] >= $items[$id_objet[0]]["pa"]){
        $repo->achat($id_perso,$id_objet[0]);
        header("location:../achatvente");
    }else{
        header("location:/achatvente");
    }
}

}