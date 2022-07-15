<?php

use PHPUnit\Framework\TestCase;

//PHPUnit testcase which performs test on the User class and its constructor variables

class UserTest extends TestCase
{
    //Test for the fullName parameter of the User class
    public function testFullName()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        $user = new User('conormcgee', 'email@email.com', 'conormcgee1995', 'mypassword');

        $this->assertEquals('conormcgee', $user->fullName);
        $this->assertNotEquals('conormagee', $user->fullName);
    }

    //Test for the email parameter of the User class
     public function testEmail()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        $user = new User('conormcgee', 'email@email.com', 'conormcgee1995', 'mypassword');

        $this->assertEquals('email@email.com', $user->email);
        $this->assertNotEquals('email123@email.com', $user->email);
    }

    //Test for the Username parameter of the User class
    public function testUsername()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        $user = new User('conormcgee', 'email@email.com', 'conormcgee1995', 'mypassword');

        $this->assertEquals('conormcgee1995', $user->username);
        $this->assertNotEquals('conormagee1994', $user->username);
    }

    //Test for the password parameter of the User class
    public function testPassword()
    {

        $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
        require_once $path;
        $user = new User('conormcgee', 'email@email.com', 'conormcgee1995', 'mypassword');

        $this->assertEquals('mypassword', $user->password);
        $this->assertNotEquals('mypassword1234', $user->password);
    }
}
