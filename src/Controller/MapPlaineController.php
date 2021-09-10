<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;


class MapPlaineController extends AbstractController
{

    public function plaine()
    {
        if (!$this->checkSecure())
        {
            header('Location: connection');     
        }
        $this->render("plaine.html",[]);
    }
}