<?php 

namespace App\Core\Security;

class AuthorizationChecker
{
    public function checkIsConnected(){
        session_start();
        return isset($_SESSION['User']) ? true : false;
    }
}