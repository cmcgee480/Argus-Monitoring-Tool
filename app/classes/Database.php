<?php
include_once('user.php');
class Database{

   public $users= array();

    public function __construct(array $users){
        $this->users=$users;
    }

    public function addUser(User $newuser){
        array_push($this->users,$newuser);
    }

    public function removeUser(User $newuser){
        $key = array_search($newuser, $this->users);
        unset($this->users[$key]);
    }

    public function getUser(User $newuser){
        
        $userIsInArray = in_array($newuser, $this->users);
        return $userIsInArray;
    }



}


?>