<?php
//session start
session_start();

//include conn.php database connection file and email-config.php which holds email credentials
include('config/conn.php');
include('config/email-config.php');



//Load Composer's autoloader
require 'vendor/autoload.php';



//if $_SESSION admin email is wrong, header function navigates to admin login page again
if (!isset($_SESSION['argusemail'])) {
    header('Location: adminlogin.php');
}
//Selects the username from the argus admin table using the admin email provided
$useremail = $_SESSION["argusemail"];
$sql = "SELECT argus_admins.username FROM argus_admins WHERE argus_admins.email ='$useremail';";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $username = $row["username"];
    }
} else {
    echo "0 results";
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

    <title>ARGUS ADMIN</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>
                <li class="active"><a href="admin.php">Admin Home</a></li>
                <li><a href="adminservices.php">Admin Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 60px; font-family: sans-serif;text-align:center;">
                Welcome Admin : <?php echo "$username" ?>!</h2>
        </div>

        <div class="button">
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="adminservices.php" class="btn">Admin Services</a>
        </div>


    </header>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>