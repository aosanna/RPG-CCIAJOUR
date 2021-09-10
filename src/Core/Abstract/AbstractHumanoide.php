<?php

namespace App\Core\Abstract;

abstract class AbstractHumanoide 
{
    protected $id;
    protected $nom;
    protected $sexe;
    protected $level;
    protected $PV;
    protected $PM;
    protected $Force;
    protected $Agi;
    protected $Int;
    protected $Race;
    protected $Classe;

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom($nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of sexe
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     */
    public function setSexe($sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set the value of level
     */
    public function setLevel($level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get the value of PV
     */
    public function getPV()
    {
        return $this->PV;
    }

    /**
     * Set the value of PV
     */
    public function setPV($PV): self
    {
        $this->PV = $PV;

        return $this;
    }

    /**
     * Get the value of PM
     */
    public function getPM()
    {
        return $this->PM;
    }

    /**
     * Set the value of PM
     */
    public function setPM($PM): self
    {
        $this->PM = $PM;

        return $this;
    }

    /**
     * Get the value of Force
     */
    public function getForce()
    {
        return $this->Force;
    }

    /**
     * Set the value of Force
     */
    public function setForce($Force): self
    {
        $this->Force = $Force;

        return $this;
    }

    /**
     * Get the value of Agi
     */
    public function getAgi()
    {
        return $this->Agi;
    }

    /**
     * Set the value of Agi
     */
    public function setAgi($Agi): self
    {
        $this->Agi = $Agi;

        return $this;
    }

    /**
     * Get the value of Int
     */
    public function getInt()
    {
        return $this->Int;
    }

    /**
     * Set the value of Int
     */
    public function setInt($Int): self
    {
        $this->Int = $Int;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of Race
     */ 
    public function getRace()
    {
        return $this->Race;
    }

    /**
     * Set the value of Race
     *
     * @return  self
     */ 
    public function setRace($Race)
    {
        $this->Race = $Race;

        return $this;
    }

    /**
     * Get the value of Classe
     */ 
    public function getClasse()
    {
        return $this->Classe;
    }

    /**
     * Set the value of Classe
     *
     * @return  self
     */ 
    public function setClasse($Classe)
    {
        $this->Classe = $Classe;

        return $this;
    }
}
