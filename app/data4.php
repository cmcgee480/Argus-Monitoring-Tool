<?php
header('Content-Type: application/json');

session_start();

include('config/conn.php');

if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
}

$useremail = $_SESSION["argusemail"];
$sql = "SELECT argus_users.userID FROM argus_users WHERE argus_users.email ='$useremail';";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $find = $row["userID"];
    }
} else {
    echo "0 results";
}



$sqlQuery = "SELECT argus_methodTimeTests.testName,argus_methodTimeTests.serviceID,argus_methodTimeTests.Data,argus_methodTimeTests.Result,argus_methodTimeTests.TimeStamp,argus_methodTimeTests.log,argus_services.userID
FROM argus_methodTimeTests JOIN argus_services 
ON argus_methodTimeTests.serviceID=argus_services.serviceID WHERE argus_services.userID=$find;";

$result = mysqli_query($conn, $sqlQuery);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
