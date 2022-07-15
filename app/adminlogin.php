<?php
//include conn.php database connection file
include('config/conn.php');

//session start
session_start();

//checks the database if the admin credentials are correct
//if the admin email and password are correct stores an admin email session variable
//Header function directs to admin homepage
//if not admin stays on login page until correct details are entered
if (isset($_POST["email"])) {


    $argusemail = $_POST["email"];

    $arguspassword  = $_POST["password"];

    $sql = "SELECT * FROM argus_admins WHERE email = '$argusemail' AND password='$arguspassword'";

    $result = $conn->query($sql);

    $numrows = $result->num_rows;

    if ($numrows > 0) {

        while ($row = $result->fetch_assoc()) {
            $_SESSION["argusemail"] = $row["email"];
        }

        header("Location: admin.php ");
    }
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

    <title>ARGUS LOGIN</title>
</head>

<body>
    <header>

        <div class="main">
            <div data-aos='fade' data-aos-duration='1000' data-aos-delay='500' class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul>
                <li data-aos='fade' data-aos-duration='1000' data-aos-delay='500'><a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="login.php">Login Page</a></li>
                <li data-aos='fade' data-aos-duration='1000' data-aos-delay='500' class="active"><a href="adminlogin.php">Admin Login</a></li>

            </ul>

        </div>
        <div class="title">
            <h1 data-aos='fade' data-aos-duration='1000' data-aos-delay='500'>Argus Admin</h1>
            <div class="text-center mt-5" data-aos='fade' data-aos-duration='1000' data-aos-delay='500'>
                <form method="POST" action="adminlogin.php" style="max-width:300px;margin:auto;">
                    <h3 style="color:white;font-family:sans-serif;">Please Sign in</h3>
                    <label for="emailAddress" class="sr-only">Email address</label>
                    <input type="email" id="emailAddress" class="form-control" placeholder="Email Address" name="email" required autofocus>
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" id="password" placeholder="Password" class="form-control" name="password">
                    <div class="mt-3">
                        <button class="btn btn-lg btn-dark btn-block">Log In</button>
                        <a href='login.php' class="btn btn-lg btn-dark btn-block">Back</a>
                    </div>
                </form>

            </div>
        </div>







    </header>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>