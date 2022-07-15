<?php
session_start();

//Argus Services Page
//Users can come to this page to access Check URL service
//From here users can navigate to Method Result/Execution time tests
//Bandwidth test can also be accessed from here
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
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
            <div data-aos='fade' data-aos-duration='1500' data-aos-delay='700' class="logo">
                <h1>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
        </div>
        <div class="title">
            <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>Our Services</h1>
        </div>

        <div class="button">
            <a href="#middle2" class="btn" data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>LEARN MORE</a>
        </div>


    </header>


    <div id="middle2">
        <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>Check if your service is available below</h1>
        <h2 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>We'll periodically monitor your service and email you if it's down</h2>
        <div class="button2">
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="checkurl.php" class="btn">CLICK HERE</a>
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="#middle3" class="btn">OR SCROLL DOWN</a>
        </div>

    </div>

    <div id="middle3">
        <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>Correctness of Results</h1>
        <h2 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>We'll execute your app's method and function tests and display the results</h2>
        <div class="button3">
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="correctTest.php" class="btn">CLICK HERE</a>
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="#middle4" class="btn">OR SCROLL DOWN</a>
        </div>

    </div>

     <div id="middle4">
        <h1 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>Bandwidth Test</h1>
        <h2 data-aos='fade' data-aos-duration='1500' data-aos-delay='700'>We'll periodically test your service's bandwidth in Mb/second</h2>
        <div class="button3">
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="correctTest.php" class="btn">CLICK HERE</a>
            <a data-aos='fade' data-aos-duration='1500' data-aos-delay='700' href="#main" class="btn">SCROLL TO TOP</a>
        </div>

    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>