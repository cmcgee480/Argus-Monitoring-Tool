<?php





//Admin function that deletes a user from Argus database using SQL queries

function adminDeleteUser($userID)
{
    include('config/conn.php');
    $userDeleted;
    $sql3 = "DELETE FROM argus_users WHERE userID=$userID;";

    $result3 = $conn->query($sql3);

    if (!$result3) {
        echo $conn->error;
    }

    $sql4 = "SELECT * FROM argus_users WHERE userID=$userID;";
    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        $userDeleted= FALSE;
    }else{
        $userDeleted= TRUE;
    }

    return $userDeleted;
}

//Admin function that deletes a service from Argus database using SQL queries

function adminDeleteService($find)
{
    include('config/conn.php');
    $serviceDeleted;

    $sql = "DELETE FROM argus_webresponse WHERE serviceID=$find;";
    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }
    $sql1 = "DELETE FROM argus_pageloadtimes WHERE serviceID=$find;";

    $result1 = $conn->query($sql1);

    if (!$result1) {
        echo $conn->error;
    }
    $sql2 = "DELETE FROM argus_pingtimes WHERE serviceID=$find;";

    $result2 = $conn->query($sql2);

    if (!$result2) {
        echo $conn->error;
    }

    $sql3 = "DELETE FROM argus_services WHERE serviceID=$find;";

    $result3 = $conn->query($sql3);

    if (!$result3) {
        echo $conn->error;
    }

    $sql4 = "SELECT * FROM argus_services WHERE serviceID=$find;";
    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        $serviceDeleted= FALSE;
    }else{
        $serviceDeleted= TRUE;
    }
    return $serviceDeleted;
}

//Admin function that adds a new user from Argus database using SQL queries

function adminAddNewUser(User $newUser)
{
    include('config/conn.php');

    $userAdded;
    $sql2 = "INSERT INTO argus_users (userID,username,password,email,FullName)
                    VALUES(null,'$newUser->username','$newUser->password','$newUser->email','$newUser->fullName')";

    $result2 = $conn->query($sql2);

    if (!$result2) {
        echo $conn->error;
    }

    $sql4 = "SELECT * FROM argus_users WHERE username='$newUser->username';";
    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        $userAdded=TRUE;
    }else{
        $userAdded=FALSE;
    }
    return $userAdded;
}

//Admin function that adds a new service from Argus database using SQL queries

function adminAddNewService(Service $service)
{
    include('config/conn.php');
    $serviceAdded;
    $sql2 = "INSERT INTO argus_services (serviceID,url,ServiceName,Status,TimeStamp,userID,hostName)
                    VALUES(null,'$service->url','$service->serviceName','UNKNOWN','0000-00-00 00:00:00','$service->userID','$service->hostName')";

    $result2 = $conn->query($sql2);

    if (!$result2) {
        echo $conn->error;
    }

    $sql4 = "SELECT * FROM argus_services WHERE ServiceName='$service->serviceName';";
    $result4 = $conn->query($sql4);
    if ($result4->num_rows > 0) {
        $serviceAdded=TRUE;
    }else{
        $serviceAdded=FALSE;
    }

    return $serviceAdded;
}


function add($a,$b){
    return $a + $b;
}
