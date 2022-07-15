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
    <link rel="stylesheet" type="text/css" href="css/style2.css">
    <style>
        ul {
            float: right;
            list-style-type: none;
            margin-top: 25px;
            font-family: sans-serif;
        }

        ul li {
            display: inline-block;
        }

        ul li a {
            text-decoration: none;
            color: white;
            padding: 5px 20px;
            border: 1px solid transparent;
            transition: 0.6s ease;
        }

        ul li a:hover {
            background-color: #fff;
            color: black;
        }

        ul li.active a {
            background-color: white;
            color: black;
        }
    </style>

    <title>SERVICE PAGE</title>
</head>

<body>
    <header>

        <div id="main">
            <div class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h1>Performance Testing</h1>
        </div>

        <div class="button">
            <a href="#middle2" class="btn">Click here to use our different performance tests</a>
        </div>


    </header>


    <div id="middle2">
        <h1>Load test your HTTP server performance</h1>
        <h2>We'll send it multiple requests at multiple times and display the results</h2>
        <div class="button2">
            <a href="httpservertest.php" class="btn">CLICK HERE FOR LOCUST</a>
           <?php echo "<a href='viewtests.php?info=$find' class='btn'>VIEW YOUR AB LOAD TESTS</a>"?> 
            <a href="#middle3" class="btn">OR SCROLL DOWN</a>
        </div>

    </div>

    <div id="middle3">
        <h1>Correctiveness of Results</h1>
        <h2>We'll perform tests to check expected results against actual results</h2>
        <div class="button3">
            <a href="checkurl.php" class="btn">CLICK HERE</a>
            <a href="#middle4" class="btn">OR SCROLL DOWN</a>
        </div>

    </div>

    <div id="middle4">
        <h1>Overall Performance Check</h1>
        <h2>We'll let you know of the overall performance of your app below</h2>
        <div class="button4">
            <a href="performancetest.php" class="btn">CLICK HERE</a>
            <a href="#main" class="btn">SCROLL TO TOP</a>
        </div>

    </div>




</body>

</html>