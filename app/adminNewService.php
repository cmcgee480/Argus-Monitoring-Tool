<?php
//session started

//Admin Add new service pages
//Admin can add new service to database by adding UserID, URL, ServiceName and HostName
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
            <h1 style="font-size:30px;">Add a new Argus service</h1>
            <form action='adminServUpload.php' method='POST' enctype='multipart/form-data'>
            <div class="form-group">
                <label for="exampleInputEmail1">User ID</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"name="userid" placeholder="User ID">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">URL</label>
                <input type="url" class="form-control" id="exampleInputURL1" name="userurl" placeholder="URL">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Service Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="serviceName" placeholder="Service Name">
            </div>
            <div class="form-group">
                <label for="exampleInputName1">Host Name</label>
                <input type="text" class="form-control" id="exampleInputName1" name="hostName" placeholder="Host Name">
            </div>
            
            <a href='adminServUpload.php'<button><input type='submit'class='btn btn-primary' value='SUBMIT'></button></a>
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="adminservices.php" class='btn btn-primary'>Back</a>
        </form>
        </div>

       


    </header>


    






</body>

</html>