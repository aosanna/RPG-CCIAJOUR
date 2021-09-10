<?php

namespace App\Core;


use App\Core\Route;
use App\Core\Request;
use App\Exception\RouterException;

class Router
{
    private $url; //contient les infos du $__GET pour le router 
    private $routes = [];//contient l'ensemble des routes dispo


    public function __construct($request)
    {
        $this->url = $request->getUri();
    }

    //créer et ajoute une route dans le tableau de la propriété route du router

    public function add($path,  $callable, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][]= $route;
        return $route;
    }

    //lance l'application en essayant de matché le param url avec la propriété path d'un objet route
    //si le match est avéré alors la fonction de l'objet route est executé
    public function run(Request $request)
    {
        if(!array_key_exists($request->getMethod(), $this->routes))
        {
            throw new RouterException("la méthode http n'existe pas");
        }

        foreach ($this->routes[$request->getMethod()] as $route)
        {
            if($route->match($this->url))
            {
                return $route->call();
            }
        }
        throw new RouterException("aucune routes n'a été trouvés pour cette url");
    }
}