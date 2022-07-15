<?php
//session started

//Admin Add new user pages
//Admin can add new user to database by adding Username, password, Email and Full name
session_start();
if (!isset($_SESSION['argusemail'])) {
    header('Location: adminlogin.php');
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style3.css">

    <title>Admin Add Service</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>
                <li><a href="admin.php">Admin Home</a></li>
                <li class="active"><a href="adminservices.php">Admin Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h1 style="font-size:30px;">Add a new Argus User</h1>
            <form action='adminUserUpload.php' method='POST' enctype='multipart/form-data'>
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="text" class="form-control" id="exampleInputURL1" name="userpassword" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Email</label>
                <input type="email" class="form-control" id="exampleInputName1" name="useremail" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Full Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="fullname" placeholder="Full Name">
            </div>
            
            <a href='adminUserUpload.php'<button><input type='submit'class='btn btn-primary' value='SUBMIT'></button></a>
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="adminservices.php" class='btn btn-primary'>Back</a>

        </form>
        </div>

       


    </header>


    






</body>

</html>