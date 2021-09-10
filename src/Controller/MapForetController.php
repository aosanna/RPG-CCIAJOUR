<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;


class MapForetController extends AbstractController
{

    public function foret()
    {
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        
        $this->render("foret.html",[]);
    }
}