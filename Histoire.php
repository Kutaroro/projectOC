<?php

class Histoire{ 

    private $id;
    private $type;
    private $univers; // A quelle histoire le personnage appartient
    private $resume; // Le personnage en quelques lignes
    private $histoires; // Morceaux d'histoires
    
    
    public function __construct(){
    }
    public function getId(){
        return $this->id;
    }
    public function getType(){
        return $this->type;
    }

    public function getUnivers(){
        return $this->univers;
    }
    public function getResume(){
        return $this->resume;
    }
    public function getHistoires(){
        return $this->histoires;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setUnivers($univers){
        $this->univers = $univers;
    }
    public function setResume($resume){
        $this->resume = $resume;
    }
    public function setHistoires($histoire){
        $this->histoire = $histoire;
    }

   


}


?>