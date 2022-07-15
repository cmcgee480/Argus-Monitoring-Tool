<?php

//Using $_GET method this section selects user from argus user table using $find variable which is userID
//includes conn.php and functions.php
//if select query returns rows the adminDeleteUser function is called passing the $IDuser variable
if (isset($_GET['info'])) {
    $find = $_GET['info'];
    include("config/conn.php");
    include("functions.php");

    $sql3 = "SELECT * FROM argus_users WHERE userID=$find;";

    $result3 = $conn->query($sql3);


    if ($result3->num_rows > 0) {
        while ($row = $result3->fetch_assoc()) {
            $IDuser = $row['userID'];
        }
    }
    adminDeleteUser($IDuser);
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

    <title>ARGUS ADMIN DELETE USER</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>
                <li><a href="admin.php">Admin Home</a></li>
                <li class="active"><a href="adminservices.php">Admin Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 40px; font-family: sans-serif;text-align:center;">
                User ID : <?php echo "$IDuser" ?> successfully deleted</h2>
        </div>

        <div class="button">
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="adminservices.php" class="btn">Back</a>
        </div>


    </header>






    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>