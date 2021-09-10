<?php

namespace App\Controller;

use App\Core\Abstract\AbstractController;
use App\Entity\User;
use App\Repository\UserRepository;

class InscriptionConnexionController extends AbstractController
{
    public function accueil()
    {
        $this->render('accueil.html', []);
    }

    public function inscription()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" )
        {
            return $this->render('inscription.html', [],true, false);
        }

        if (!empty($_POST))
        {
            $args = 
                [
                    "pseudo" => 
                        [
                            "filter" => FILTER_VALIDATE_REGEXP,
                            "options" =>
                                [
                                    "regexp" => "#^[\w\s-]+$#u"
                                ]
                        ],
                    "mdp" => [],
                    "vmdp" => []
                ];
        }
        
        $inputs = filter_input_array(INPUT_POST, $args);

        if ($inputs["pseudo"] === false && empty($inputs["mdp"]) && empty($inputs["vmdp"]))
        {
            $error_messages[] = "Veuillez remplir tous les champs";
        }
        else
        {
            if ($inputs["pseudo"] === false && empty(trim($inputs["pseudo"])))
            {
            $error_messages[] = "Pseudo inexistant";
            }

            $userRepo = new UserRepository();
            $user = $userRepo->findUserByPseudo($_POST['pseudo']);
            if ($user instanceof User)
            {
                $error_messages[] = "Ce pseudo existe déjà";
            }

            if (empty($inputs["mdp"]) || empty($inputs["vmdp"]) || $inputs["mdp"] !== $inputs["vmdp"])
            {
                $error_messages[] = "Les deux mots de passe doivent correspondre";
            }
        }

        //inscription
        if (empty($error_messages))
        {
                //renvoi sur une page d'inscription
                $userRepo = new UserRepository();
                $user = new User();
                $user->setPseudo($inputs["pseudo"]);
                $user->setMdp($inputs["mdp"]);
                $userRepo->addUser($user);
                header("Location: connection");
        }
        else
        {
            $this->render('inscription.html', [
                "errors" => $error_messages
            ], true, false);
        }              
    }
    
    public function connection()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" )
        {
            return $this->render('connection.html', [], true, false);
        }

        $userRepo = new UserRepository();
        $user = $userRepo->findUserByPseudo($_POST['pseudo']);
        $idjoueur= $userRepo->comparaison($_POST["pseudo"]);
        if ($user instanceof User && $user->getMdp() === $_POST['mdp']) 
        {
            session_start();
            $_SESSION['User'] = $_POST['pseudo'];
            $_SESSION['IdUser'] = $idjoueur[0]['id_joueur'];
            header("Location: moncompte");
        }
        else
        {
            $error_messages[] = "Aucun compte existant";
            $this->render('connection.html', [
                "errors" => $error_messages
            ], true, false);
        }
    }

    public function deconnection()
    {
        session_destroy();
        unset($_SESSION);

        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            null,
            strtotime('yesterday'),
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
        header("Location: connection");
    }
}