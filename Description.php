<?php

class Description{

    private $id;
    private $genre;
    private $taille;
    private $race;
    private $physique;
    private $caractere;
    private $idPersonnage;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }
    public function getGenre(){  
        return $this->genre;
    }
    public function getTaille(){   
        return $this->taille;
    }
    public function getRace(){   
        return $this->race;
    }
    public function getPhysique(){ // peut changer 
        return $this->physique;
    }
    public function getCaractere(){// peut changer 
        return $this->caractere;
    }
    public function getIDpersonnage(){
        return $this->idPersonnage;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setGenre($genre){
        $this->genre = $genre;
    }
    public function setTaille($taille){
        $this->taille = $taille;
    }
    public function setRace($race){
        $this->race = $race;
    }
    public function setPhysique($physique){
        $this->physique = $physique;
    }
    public function setCaractere($caractere){
        $this->caractere = $caractere;
    }
    public function setIdpersonnage($idpersonnage){
        $this->idpersonnage = $idpersonnage;
    }
    public function __toString(){
        return $this->genre." ".$this->race."~".$this->taille."
        Description physique:".$this->physique."
        Personalité:".$this->caractere;  

    }
}


?>