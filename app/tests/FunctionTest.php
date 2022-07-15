<?php


use PHPUnit\Framework\TestCase;

class FunctionTest extends TestCase
{
    //Test that will check if Admin funtion Add new User works correctly
    //Adds new user to mock database array
    //returns true boolean if success or false boolean if failed
    public function testAdminUserIsAdded()
    {
        
        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        include_once('MockFunctions.php');
        $user1 = new User('conormcgee','fakeemail@com','testusername','testpassword');
        $expectedBoolean = true;
        $actualBoolean = mockAdminAddNewUser($user1);
        $this->assertEquals($expectedBoolean,$actualBoolean);
        


    }

     //Test that will check if Admin funtion Delete User works correctly
    //Deletes new user From mock database array
    //returns true boolean if success or false boolean if failed
    public function testAdminUserIsDeleted()
    {
        
        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        include_once('MockFunctions.php');
        $user1 = new User('conormagee','fakeemail@com','testusername','testpassword');
        $expectedBoolean = true;
        mockAdminAddNewUser($user1);
        $actualBoolean = mockAdminDeleteUser($user1);
        $this->assertEquals($expectedBoolean,$actualBoolean);
        


    }


     //Test that will check if Admin funtion Add new Service works correctly
    //Adds new service to mock database array
    //returns true boolean if success or false boolean if failed
    public function testAdminServiceIsAdded()
    {
        
        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        include_once('MockFunctions.php');
        $service = new Service('https://testurl.com', 'testservicename', '1001', 'testhostName');
        $expectedBoolean = true;
        $actualBoolean = mockAdminAddNewService($service);
        $this->assertEquals($expectedBoolean,$actualBoolean);
        


    }


     //Test that will check if Admin funtion Delete Service works correctly
    //Deletes service from mock database array
    //returns true boolean if success or false boolean if failed
    public function testAdminServiceIsDeleted()
    {
        
        $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
        require_once $path;
        include_once('MockFunctions.php');
        $service = new Service('https://testurl.com', 'testservicename', '1001', 'testhostName');
        mockAdminAddNewService($service);
        $expectedBoolean = true;
        $actualBoolean = mockAdminDeleteService($service);
        $this->assertEquals($expectedBoolean,$actualBoolean);
        


    }

    
}