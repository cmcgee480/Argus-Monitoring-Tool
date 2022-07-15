<?php


//Page which displays all the services Method Execution time tests
//Displays the results in grid form
//If test was successful, displays a green tick and if failed, a red tick
//Displays the timestamp of the periodic test and a log
//Displays the execution time of the test in the form of a green gauge meter
if (isset($_GET['info'])) {
    $find = $_GET['info'];

    include('config/conn.php');


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

    <link rel="stylesheet" type="text/css" href="css/style7.css">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    <style type="text/css">
        #chart-container {
            width: 460PX;
            height: auto;
        }
    </style>

    <title>METHOD EXECUTION TESTS</title>
    <style>
        .progress {
            position: relative;
            width: 210px;
            height: 30px;
            background: grey;
            border-radius: 5px;
            overflow: hidden;
            margin-left: 40px;

        }

        .progress_fill {
            width: 50%;
            height: 100%;
            background: lightgreen;
        }

        .progress_text {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            font: bold 14px 'Quicksand', sans-serif;
            color: white;
        }
    </style>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
</head>

<body>
    <header style=" border: 5px;
    border-color: rgb(3, 3, 3);
    border-style: outset;">

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
                Execution time tests for Service ID: <?php echo "$find" ?></h2>
        </div>

        <div class="button">
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="correctTest.php" class="btn">Back</a>
            <a data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' href="#middle2" class="btn">Click</a>
        </div>


    </header>


    <div id="middle2" style="height:auto">

        <div style="font-family:sans-serif;margin-right: 30px;color:darkslategray" class='content'>
            <ul class="grid columns-3">

                <?php if ($result3->num_rows > 0) {
                    while ($row = $result3->fetch_assoc()) {
                        $data = $row['Data'];
                        $timeData = $data * 10;
                        $newTimeData = sprintf("%.5f", $data);
                        $resultURL = $row['Result'];
                        if ($resultURL == 'PASS') {
                            $imgURL = "img/greentick.jpeg";
                        } else {
                            $imgURL = "img/redX.jpeg";
                        }
                        echo " 
                      <li data-aos='fade-up' 
                        data-aos-duration='800' 
                        data-aos-delay='200' style=' float: right;
                        display: block;
                        width: 33%;
                        padding-left: 90px;'>
                        <img style='box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
                        border-radius: 10px;
                        border: 2px solid black;
                        padding: 16px;' src='$imgURL' alt='image' width ='250' height='250'></a>
                                <h2 style='margin-top:20px;'>{$row['testName']}</h2>
                                <p style='font-size:20px;' >{$row['Result']}<p>
                                <p style='font-size:20px;'>Time: {$row['Data']} milliseconds<p>
                                <div class='progress'>
                                <div class='progress_fill'style='width:$timeData%;'></div>
                                <span class='progress_text'>$newTimeData</span>
                                </div>
                               <p style='font-size:20px;padding:30px;' >Date: {$row['TimeStamp']}<p>
                                
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