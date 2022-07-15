<?php
//Argus service page
//Users can add a service they want Argus to check
//They can add their email and if argus is down they will recieve an email letting them know
//PHPMailer is used to send them a message
session_start();
if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
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

    <title>CHECK SERVICE RESPONSE CODE</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="services.php"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h1 style="font-size:30px;">Enter the url of your service. We can check its status and will email you if there's an issue.</h1>
            <form action='responseurl.php' method='POST' enctype='multipart/form-data'>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"name="useremail" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
            
            <a href='responseurl.php'<button><input type='submit'class='btn btn-primary' value='SUBMIT'></button></a>
        </form>
        </div>

       


    </header>


    






</body>

</html>