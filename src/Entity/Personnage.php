<?php 

namespace App\Entity;

use App\Core\Abstract\AbstractHumanoide;

class Personnage extends AbstractHumanoide
{
    private int $Or;
    private int $id_joueur;

    /**
     * Get the value of Or
     */ 
    public function getOr()
    {
        return $this->Or;
    }

    /**
     * Set the value of Or
     *
     * @return  self
     */ 
    public function setOr($Or)
    {
        $this->Or = $Or;

        return $this;
    }

    /**
     * Get the value of id_joeuur
     */ 
    public function getId_joueur()
    {
        return $this->id_joueur;
    }

    /**
     * Set the value of id_joeuur
     *
     * @return  self
     */ 
    public function setId_joueur($id_joueur)
    {
        $this->id_joueur = $id_joueur;

        return $this;
    }
}