<?php

use PHPUnit\Framework\TestCase;

//PHPUnit testcase which performs test on the Service class and its constructor variables

class ServiceTest extends TestCase
{
    //Test for the URL parameter of the Service class
    public function testServiceUrl()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        $service = new Service('http://www.google.co.uk','google','1001','www.google.com');

        $this->assertEquals('http://www.google.co.uk', $service->url);
        $this->assertNotEquals('http://www.facebook.co.uk', $service->url);
    }

    //Test for the ServiceName parameter of the Service class
    public function testServiceName()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        $service = new Service('http://www.google.co.uk','google','1001','www.google.com');

        $this->assertEquals('google', $service->serviceName);
        $this->assertNotEquals('facebook', $service->serviceName);
    }

    //Test for the UserID parameter of the Service class
    public function testUserID()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        $service = new Service('http://www.google.co.uk','google','1001','www.google.com');

        $this->assertEquals('1001', $service->userID);
        $this->assertNotEquals('1002', $service->userID);
    }

    //Test for the hostName parameter of the Service class
    public function testhostName()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        $service = new Service('http://www.google.co.uk','google','1001','www.google.com');

        $this->assertEquals('www.google.com', $service->hostName);
        $this->assertNotEquals('www.facebook.com', $service->hostName);
    }



}
