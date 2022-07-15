<?php

//Page which displays all the services Method Result tests
//Displays the results in grid form
//If test was successful, displays a green tick and if failed, a red tick
//Displays the timestamp of the periodic test and a log
if (isset($_GET['info'])) {
    $find = $_GET['info'];

    include('config/conn.php');

    $sql2 = "SELECT * FROM argus_methodTests WHERE serviceID=$find;";

    $result2 = $conn->query($sql2);


    if (!$result2) {
        echo $conn->error;
    }


    $sql3 = "SELECT * FROM argus_methodTimeTests WHERE serviceID=$find;";

    $result3 = $conn->query($sql3);


    if (!$result3) {
        echo $conn->error;
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
    <link rel="stylesheet" type="text/css" href="css/style6.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>

    <title>METHOD TESTS</title>
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
        </div>
        <div class="title">
            <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 60px; font-family: sans-serif;text-align:center;">
                Method tests for Service ID: <?php echo "$find" ?></h2>
        </div>

        <div class="button">
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="correctTest.php" class="btn">Back</a>
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="#middle2" class="btn">Click</a>
        </div>


    </header>


    <div id="middle2">


        <div style="font-family:sans-serif;
        margin-right: 30px; 
        color:darkslategrey;
        background-image: url('../img/background.jpeg');" class='content'>
            <ul class="grid columns-3">

                <?php if ($result2->num_rows > 0) {
                    while ($row = $result2->fetch_assoc()) {
                        $resultURL = $row['Result'];
                        if ($resultURL == 'PASS') {
                            $imgURL = "img/greentick.jpeg";
                        } else {
                            $imgURL = "img/redX.jpeg";
                        }
                        echo "<li data-aos='fade-up' 
                        data-aos-duration='800' 
                        data-aos-delay='200' style=' float: right;
                        display: block;
                        width: 33%;
                        padding-left: 90px;'>
                        <img src='$imgURL' alt='image' width ='250' height='250'></a>
                                <h2 style='margin-top:20px;'>{$row['testName']}</h2>
                                <p style='font-size:20px;' >Result: {$row['Result']}<p>
                                <p style='font-size:20px;' >Date: {$row['TimeStamp']}<p>
                                <p style='font-size:20px;'>Log: {$row['log']}<p>
                                </li>";
                    }
                }
                ?>


            </ul>
        </div>


    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>



</body>

</html>