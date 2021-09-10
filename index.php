<?php

use App\Controller\InventaireController;
use App\Controller\PopupInventaireController;
use App\Controller\VenteController;
use App\Controller\AchatController;
use App\Controller\BoutiqueController;
use App\Controller\InscriptionConnexionController;
use App\Controller\ListeController;
use App\Controller\MapForetController;
use App\Controller\MapPlaineController;
use App\Controller\MapVilleController;
use App\Controller\MonCompteController;
use App\Controller\NewPersoController;
use App\Controller\RecupIdPersoController;
use App\Core\Request;
use App\Core\Router;

require 'vendor/autoload.php';



$request=new Request();




if($request->getFilenameExtension() === "png" || $request->getFilenameExtension() === "jpg")
{
    header("Content-type: image/png");
    readfile($request->getScriptFileName());
    
}else if($request->getFilenameExtension() === "css"){
    header("Content-type: text/css");
    readfile($request->getScriptFileName());
    
}else if($request->getFilenameExtension() === "js"){
        header("Content-type: text/javascript");
        readfile($request->getScriptFileName());
}else{

    $router = new Router($request);

     /*----------------------------Gestion de la boutique et du routage des maps ----------------------------------- */
    $bcontroller = new BoutiqueController();
    $mvcontroller = new MapVilleController();
    $mfcontroller = new MapForetController();
    $mpcontroller = new MapPlaineController();
    $avcontroller = new InventaireController();
    $invcontroller = new PopupInventaireController();
    $vcontroller = new VenteController();
    $acontroller = new AchatController();

    /*----------------gestion de la connection deconnexion et de la page mon compte ----------------------------- */
    $InscriptionConnexionController = new InscriptionConnexionController();
    $monCompteController = new MonCompteController();




    /*----------------gestion des personnages et de leurs interfaces ----------------------------- */

    $FormNewPerso = new NewPersoController();
    $NewPerso = new NewPersoController();
    $recuId = new RecupIdPersoController();


    /*-------------------------Gestion de la boutique et du routage des maps ------------------------------------ */

    $router->add("achatvente", [$avcontroller,"index"], $request->getMethod());
    $router->add("boutique", [$bcontroller,"boutique"], $request->getMethod());
    $router->add("vente/:idInv", [$vcontroller,"Vente"], $request->getMethod());
    $router->add("achat/:idObjet", [$acontroller,"Achat"], $request->getMethod());
    $router->add("ville", [$mvcontroller,"ville"], $request->getMethod());
    $router->add("foret", [$mfcontroller,"foret"], $request->getMethod());
    $router->add("plaine", [$mpcontroller,"plaine"], $request->getMethod());
    $router->add("inventaire", [$invcontroller,"inventaire"], $request->getMethod());

    /*----------------gestion de la connection deconnexion et de la page mon compte ----------------------------- */

    $router->add("accueil", [$InscriptionConnexionController, 'accueil'], $request->getMethod());
    $router->add("inscription", [$InscriptionConnexionController, 'inscription'], "POST");
    $router->add("inscription", [$InscriptionConnexionController, 'inscription'], $request->getMethod());
    $router->add("connection", [$InscriptionConnexionController, 'connection'], "POST");
    $router->add("connection", [$InscriptionConnexionController, 'connection'], $request->getMethod());
    $router->add("moncompte", [$monCompteController, 'monCompte'], $request->getMethod());
    $router->add("deconnection", [$InscriptionConnexionController, 'deconnection'], $request->getMethod());


    /*----------------gestion des personnages et de leurs interfaces ----------------------------- */

    $router->add("NewPerso", [$NewPerso,"NewPerso"], $request->getMethod());
    $router->add("FormNewPerso", [$FormNewPerso,"FormNewPerso"], $request->getMethod());
    $router->add("recupId/:id", [$recuId,"RecupId"], $request->getMethod());





    $router->run($request);
}

