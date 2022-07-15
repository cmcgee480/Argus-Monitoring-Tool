<?php
header('Content-type: application/json');
include("conn.php");

if (isset($_GET['services'])) {
    include("conn.php");

    $sql = 'SELECT argus_users.userID,username, password,email, FullName,argus_services.serviceID,argus_services.url,argus_services.ServiceName,argus_services.Status,argus_services.ActiveSince,argus_services.inActiveSince,argus_services.hostName
            FROM argus_users JOIN argus_services 
            ON argus_users.userID = argus_services.userID;';


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'userID' => $row['userID'],
                'username' => $row['username'],
                'password' => $row['password'],
                'email' => $row['email'],
                'FullName' => $row['FullName'],
                'serviceID' => $row['serviceID'],
                'url' => $row['url'],
                'ServiceName' => $row['ServiceName'],
                'Status' => $row['Status'],
                'ActiveSince' => $row['ActiveSince'],
                'inActiveSince' => $row['inActiveSince'],
                'hostName' => $row['hostName']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}


if (isset($_GET['allservices'])) {
    include("conn.php");

    $sql = 'SELECT * FROM argus_services;';


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'servicID' => $row['serviceID'],
                'url' => $row['url'],
                'ServiceName' => $row['ServiceName'],
                'Status' => $row['Status'],
                'TimeStamp' => $row['TimeStamp'],
                'userID' => $row['userID'],
                'hostName' => $row['hostName']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}




if (isset($_GET['userID'])) {
    include("conn.php");
    $find = $_GET['userID'];


    $sql = "SELECT argus_users.userID,username, password,email, FullName,argus_services.serviceID,argus_services.url,argus_services.ServiceName,argus_services.Status,argus_services.TimeStamp
    FROM argus_users JOIN argus_services 
    ON argus_users.userID = argus_services.userID WHERE argus_users.userID = $find;";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'userID' => $row['userID'],
                'username' => $row['username'],
                'password' => $row['password'],
                'email' => $row['email'],
                'FullName' => $row['FullName'],
                'serviceID' => $row['serviceID'],
                'url' => $row['url'],
                'ServiceName' => $row['ServiceName'],
                'Status' => $row['Status'],
                'TimeStamp' => $row['TimeStamp']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}

if (isset($_GET['username'])) {
    include("conn.php");
    $find = $_GET['username'];


    $sql = "SELECT argus_users.userID,username, password,email, FullName,argus_services.serviceID,argus_services.url,argus_services.ServiceName
    FROM argus_users JOIN argus_services 
    ON argus_users.userID = argus_services.userID WHERE argus_users.username = '$find';";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'userID' => $row['userID'],
                'username' => $row['username'],
                'password' => $row['password'],
                'email' => $row['email'],
                'FullName' => $row['FullName'],
                'serviceID' => $row['serviceID'],
                'url' => $row['url'],
                'ServiceName' => $row['ServiceName']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}


if (isset($_GET['serviceID'])) {
    include("conn.php");
    $find = $_GET['serviceID'];


    $sql = "SELECT argus_services.serviceID,argus_services.url,argus_services.ServiceName,argus_services.Status,argus_services.userID,argus_services.hostName,argus_users.username
    FROM argus_services JOIN argus_users 
    ON argus_services.userID = argus_users.userID WHERE argus_services.serviceID = $find;";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'serviceID' => $row['serviceID'],
                'url' => $row['url'],
                'ServiceName' => $row['ServiceName'],
                'Status' => $row['Status'],
                'userID' => $row['userID'],
                'hostName' => $row['hostName'],
                'username' => $row['username']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}


if (isset($_GET['testuserID']) ) {
    include("conn.php");
    $find = $_GET['testuserID'];


    $sql = "SELECT * FROM argus_loadtests WHERE userID=$find";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $service = [
                'testID' => $row['testID'],
                'serviceID' => $row['serviceID'],
                'userID' => $row['userID'],
                'testName' => $row['testName'],
                'graphURL' => $row['graphURL']
            ];
            array_push($users, $service);
        }

        $json = json_encode(mb_convert_encoding($users, "UTF-8", "UTF-8"));
        if ($json === false) {
            // Avoid echo of empty string (which is invalid JSON), and
            // JSONify the error message instead:
            $json = json_encode(["jsonError" => json_last_error_msg()]);
            if ($json === false) {
                // This should not happen, but we go all the way now:
                $json = '{"jsonError":"unknown"}';
            }
            // Set HTTP response status code to: 500 - Internal Server Error
            http_response_code(500);
        }
        echo $json;
    }
}
