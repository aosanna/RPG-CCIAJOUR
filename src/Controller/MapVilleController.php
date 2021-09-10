<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;


class MapVilleController extends AbstractController
{

    public function ville()
    {
        
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        $this->render("ville.html",[]);
    }
}