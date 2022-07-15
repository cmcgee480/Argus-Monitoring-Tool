<?php

class ServiceDatabase{

   public $services= array();

    public function __construct(array $services){
        $this->services=$services;
    }

    public function addService(Service $newservice){
        array_push($this->services,$newservice);
    }

    public function removeService(Service $newservice){
        $key = array_search($newservice, $this->services);
        unset($this->services[$key]);
    }

    public function getService(Service $newservice){
        
        $serviceIsInArray = in_array($newservice, $this->services);
        return $serviceIsInArray;
    }



}


?>