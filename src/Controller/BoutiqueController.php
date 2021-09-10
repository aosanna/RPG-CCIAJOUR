<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;


class BoutiqueController extends AbstractController
{

    public function boutique()
    {
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        $this->render("Boutique.html",[]);
        
    }
}