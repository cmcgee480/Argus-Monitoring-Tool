<?php

session_start();
include('config/conn.php');


if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
}

$useremail = $_SESSION["argusemail"];
$sql = "SELECT argus_users.username, argus_users.userID FROM argus_users WHERE argus_users.email ='$useremail';";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
        $find = $row["userID"];
    }
} else {
    echo "0 results";
}






$sql2 = "SELECT argus_users.userID,username, password,email, FullName,argus_services.serviceID,argus_services.url,argus_services.ServiceName,argus_services.Status
FROM argus_users JOIN argus_services 
ON argus_users.userID = argus_services.userID WHERE argus_users.username = '$username';";



$result2 = $conn->query($sql2);
if (!$result2) {
    echo $conn->error;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@200&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <title>CHOOSE CORRECT TEST</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>

            <div class="title">
                <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 50px; font-family: sans-serif;text-align:center;">
                    Choose a service to Test</h2>
            </div>

            <div class="button">
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="index.php" class="btn">Your Dashboard</a>
                <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="#middle2" class="btn">Click Here</a>
                
            </div>

        </div>




    </header>

    <div id="middle2">
        <h1 data-aos='fade' data-aos-duration='800' data-aos-delay='500'>Service Dashboard</h1>
        <h2 style="font-size:30px;" data-aos='fade' data-aos-duration='800' data-aos-delay='700'>Choose a service to view its tests</h2>
        <div class="content" style="height: 50px;font-size: 20px; margin-bottom: 0px;
                 padding-bottom: 0px;">
            <div data-aos='fade-up' data-aos-duration='1000' data-aos-delay='600' class='servicedashboard'>

                <table class='table table-dark table-hover'>
                    <thead>
                        <tr>
                            <th>ServiceID</th>
                            <th>Username</th>
                            <th>ServiceName</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <?php
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "  <tbody>
                        <tr>
                            <td>{$row['serviceID']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['ServiceName']}</td>
                            <td>{$row['Status']}</td>
                            <td><a href='viewCorrectTest.php?info={$row['serviceID']}' class='viewbutton'>Test</a></td>
                            <td><a href='serviceDetail.php?info={$row['serviceID']}' class='viewbutton'>View Details</a></td>
                            
                        </tr>
                    </tbody>";
                        }
                    }
                    ?>








                </table>



            </div>
        </div>


    </div>







    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>