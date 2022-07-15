<?php



//Admin function that adds a new user from Argus database using SQL queries
//Mock Database class which contains array of users is used in place of MySQL database 
function mockAdminAddNewUser(User $newUser)
{
    $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
    require_once $path;
    $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/Database.php";
    require_once $pathdb;
    $user1 = new User('fakefullname', 'fakeemail@skdfjsdf.com', 'fakeusernamefake', 'fakepasswordfake');
    $user2 = new User('fakename', 'email@email.com', 'fakeusername', 'passwordfake');
    $users = array();
    $users[] = $user1;
    $users[] = $user2;
    $db = new Database($users);
    $newuser = new User($newUser->fullName, $newUser->email, $newUser->username, $newUser->password);
    $db->addUser($newuser);
    $userAdded;

    if ($db->getUser($newuser) == true) {
        $userAdded = true;
    } else {
        $userAdded = false;
    }
    return $userAdded;
}





//Admin function that deletes a user from Argus database using SQL queries
//Mock Database class which contains array of users is used in place of MySQL database 
function mockAdminDeleteUser($user)
{

    $path = realpath(dirname(dirname(__FILE__))) . "/classes/user.php";
    require_once $path;
    $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/Database.php";
    require_once $pathdb;
    $user1 = new User('fakefullname', 'fakeemail@skdfjsdf.com', 'fakeusernamefake', 'fakepasswordfake');
    $user2 = new User('fakename', 'email@email.com', 'fakeusername', 'passwordfake');
    $users = array();
    $users[] = $user1;
    $users[] = $user2;
    $db = new Database($users);
    $db->removeUser($user);
    $userDeleted;

    if ($db->getUser($user) == true) {
        $userDeleted = false;
    } else {
        $userDeleted = true;
    }
    return $userDeleted;
}


//Admin function that adds a new service from Argus database using SQL queries
//Mock ServiceDatabase class which contains array of services is used in place of MySQL database 
function mockAdminAddNewService(Service $newService)
{
    $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
    require_once $path;
    $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/DatabaseServ.php";
    require_once $pathdb;
    $service1 = new Service('https://stackoverflow.com/', 'stackoverflow', '1001', 'www.stackoverflow.com');
    $service2 = new Service('https://www.youtube.com/', 'youtube', '1001', 'www.youtube.com');
    $services = array();
    $services[] = $service1;
    $services[] = $service2;
    $db = new ServiceDatabase($services);
    $db->addService($newService);
    $serviceAdded;

    if ($db->getService($newService) == true) {
        $serviceAdded = true;
    } else {
        $serviceAdded = false;
    }
    return $serviceAdded;
}

//Admin function that deletes a service from Argus database using SQL queries
//Mock ServiceDatabase class which contains array of services is used in place of MySQL database 
function mockAdminDeleteService(Service $service)
{

    $path = realpath(dirname(dirname(__FILE__))) . "/classes/services.php";
    require_once $path;
    $pathdb = realpath(dirname(dirname(__FILE__))) . "/classes/DatabaseServ.php";
    require_once $pathdb;
    $service1 = new Service('https://stackoverflow.com/', 'stackoverflow', '1001', 'www.stackoverflow.com');
    $service2 = new Service('https://www.youtube.com/', 'youtube', '1001', 'www.youtube.com');
    $services = array();
    $services[] = $service1;
    $services[] = $service2;
    $db = new ServiceDatabase($services);
    $db->removeService($service);
    $serviceDeleted;

    if ($db->getService($service) == true) {
        $serviceDeleted = false;
    } else {
        $serviceDeleted = true;
    }
    return $serviceDeleted;
}
