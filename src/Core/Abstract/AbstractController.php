<?php

namespace App\Core\Abstract;

use App\Core\Security\AuthorizationChecker;

abstract class AbstractController
{
    const BASEPATH = 'Templates/';

    public function render(string $path, array $datas, bool $header = true, bool $footer = true)
    {
        ob_start(); //début de la mise en tampon
        if($header){
        include self::BASEPATH . 'header.html';
        }
        extract($datas);
        include self::BASEPATH . $path;
        if($footer){
        include self::BASEPATH . 'footer.html';
        }
        echo ob_get_clean(); // la vidange de la mémoire tampon et fermeture 
    }

    public function checkSecure()
    {
        $security = new AuthorizationChecker();
        return  $security->checkIsConnected();
    }
}