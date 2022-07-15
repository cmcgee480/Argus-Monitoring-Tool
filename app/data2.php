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

//Data page which is used to collect web response metrics from database and convert them to json for Chart.JS to use 
//Chart.js uses this json to create an array and is used in the argus serviceDetail.php page
// to create a webresponse time Chart

$sqlQuery = "SELECT argus_webresponse.responseID,argus_webresponse.serviceID,argus_webresponse.timeInMilliseconds,argus_services.ServiceName,argus_services.userID 
FROM argus_webresponse JOIN argus_services 
ON argus_webresponse.serviceID=argus_services.serviceID WHERE argus_services.userID=$find";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
