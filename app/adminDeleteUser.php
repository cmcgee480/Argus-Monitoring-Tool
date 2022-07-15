<?php
//session started
session_start();
//if $_SESSION admin email is wrong, header function navigates to admin login page again
if (!isset($_SESSION['argusemail'])) {
    header('Location: adminlogin.php');
}
//include conn.php database connection file
include("config/conn.php");


//SELECT all of the user details from the argus_user table
$sql2 = "SELECT argus_users.userID,argus_users.username, argus_users.password,argus_users.email, argus_users.FullName
FROM argus_users;";



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

    <title>ADMIN DELETE USER</title>
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
            <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 60px; font-family: sans-serif;text-align:center;">
                Admin Delete User</h2>
        </div>

        <div class="button">

            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="#middle2" class="btn">Click Here</a>
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="adminservices.php" class="btn">Back</a>
        </div>


    </header>


    <div id="middle2">
        <h1 data-aos='fade' data-aos-duration='800' data-aos-delay='500'>Service Dashboard</h1>

        <div class="content" style="height: 50px;font-size: 20px; margin-bottom: 0px;
        padding-bottom: 0px;">
            <div data-aos='fade-up' data-aos-duration='1000' data-aos-delay='600' class='servicedashboard'>

                <table class='table table-dark table-hover'>
                    <thead>
                        <tr>
                            <th>UserID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th></th>


                        </tr>
                    </thead>
                <!-- Presents all of the users in a dashboard. Admin can delete any user from here-->
                    <?php
                    if ($result2->num_rows > 0) {
                        while ($row = $result2->fetch_assoc()) {
                            echo "  <tbody>
                        <tr>
                            <td>{$row['userID']}</td>
                            <td>{$row['FullName']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td><a href='adDeleteUser.php?info={$row['userID']}' class='viewbutton'>Delete</a></td>
                            
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