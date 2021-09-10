<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Repository\ListePersonnageRepository;

class MonCompteController extends AbstractController
{
    public function monCompte()
    {
        if (!$this->checkSecure()) {
            header('Location: connection');
        }

        $listePersos = new ListePersonnageRepository();
        $listePerso = $listePersos->getUserById($_SESSION['IdUser']);

        $this->render("moncompte.html", [
            "listeperso" => $listePerso,
        ], true, false);
    }
}