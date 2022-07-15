<?php

class Service
{

    public $url;
    public $serviceName;
    public $userID;
    public $hostName;




    public function __construct(string $url, string $serviceName, int $userID, string $hostName)
    {

        $this->url = $url;
        $this->serviceName = $serviceName;
        $this->userID = $userID;
        $this->hostName = $hostName;
    }
}



?>
