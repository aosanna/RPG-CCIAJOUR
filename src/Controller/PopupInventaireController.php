<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;


class PopupInventaireController extends AbstractController
{

    public function inventaire()
    {
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        
        $this->render("Inventaire.html",[],false,false);
    }
}