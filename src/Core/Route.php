<?php

namespace App\Core;

class Route{

    private string $path;
    private $callable;
    private $matches = [];

    public function __construct(string $path, $callable)
    {
        $this->path = $path;
        $this->callable = $callable;
    }

    public function match(string $url): bool
    {
        //permet d'enlever les / au bébut et à la fin de l'url
        $url = trim($url, '/');
        //permet de réecrir le path en remplacant après les : par un regex
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        
        // on structure un regex afin de matché et d'isoler les params si ils sont existant 
        $regex = "#^$path$#i";

        //recherche une corespondance entre $regex et $url pour voir si ils matchent si il y en a pas alors il retourne faux
        if(!preg_match($regex,$url,$matches)){
            //retourne faux
            return false;
        }
        //enleve la premiere valeur du tableaux $matches
        array_shift($matches);
        //on passes les parametres dans la propriétés
        $this->matches = $matches;
        return true;
    }

    public function call()
    {
        
        //on execute la fct en lui passant les param relatif a la route
        return call_user_func($this->callable, $this->matches);
    }
}
