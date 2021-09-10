<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;

class RecupIdPersoController extends AbstractController
{

    public function RecupId($id){
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        
        $_SESSION["idPerso"] = $id[0];

        header("location: ../boutique");
        exit;
    }
}
