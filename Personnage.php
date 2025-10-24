<?php
class Personnage{

    private $id;
    private $nom;
    private $histoire;
    private $description;
   

    public function __construct(){

    }
    public function getId(){    
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getHistoire(){
        return $this->histoire;
    }
    public function getDescription(){
        return $this->description;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function setNom($nom){
        $this->nom = $nom;
    }
    public function setHistoire($histoire){
        $this->histoire = $histoire;
    }
    public function setDescription($description){
        $this->description = $description;
    } 
        


}


?>