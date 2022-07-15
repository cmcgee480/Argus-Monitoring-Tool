<?php

session_start();
//Service Detail Page
//Displays all of a services details, web reponse time, page load time, ping time
//Status of service
//Includes an Active Since: status which shows how long the service has been active for since its been created
//Or has gone down in the past

if (!isset($_SESSION['argusemail'])) {
    header('Location: login.php');
}

if (isset($_GET['info'])) {
    $find = $_GET['info'];

    include('config/conn.php');
    $sql = "SELECT * FROM argus_services WHERE serviceID=$find;";

    $result = $conn->query($sql);

    if (!$result) {
        echo $conn->error;
    }

    $sql2 = "SELECT * FROM argus_services WHERE serviceID=$find;";

    $result2 = $conn->query($sql);

    if (!$result2) {
        echo $conn->error;
    }
}

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $ch = curl_init($row['url']);
        $url = $row['url'];
        $hostname = $row['hostName'];
        $status = $row['Status'];
        $serviceName = $row['ServiceName'];
    }
}


$sql3 = "SELECT * FROM argus_webresponse WHERE serviceID=$find;";
$result3 = $conn->query($sql3);
if (!$result3) {
    echo $conn->error;
}

if ($result3->num_rows > 0) {
    while ($row = $result3->fetch_assoc()) {
        $webResponse = $row['timeInMilliseconds'];
    }
}
$sql4 = "SELECT * FROM argus_pageloadtimes WHERE serviceID=$find;";
$result4 = $conn->query($sql4);
if (!$result4) {
    echo $conn->error;
}
if ($result4->num_rows > 0) {
    while ($row = $result4->fetch_assoc()) {
        $pageLoad = $row['timeInMilliseconds'];
    }
}
$sql5 = "SELECT * FROM argus_pingtimes WHERE serviceID=$find;";
$result5 = $conn->query($sql5);
if (!$result5) {
    echo $conn->error;
}
if ($result5->num_rows > 0) {
    while ($row = $result5->fetch_assoc()) {
        $pingTime = $row['timeInMilliseconds'];
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
    <link rel="stylesheet" type="text/css" href="css/style5.css">

    <title>Service Details</title>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/Chart.min.js"></script>
    <!-- Chart container css-->
    <style type="text/css">
        #chart-container {
            width: 460PX;
            height: auto;
        }

        #chart-container2 {
            width: 460PX;
            height: auto;
        }

        #chart-container3 {
            width: 460PX;
            height: auto;
        }
    </style>
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

    </header>

    <div class="title">
        <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 30px; font-family: sans-serif;text-align:center;">
            Dashboard of Service ID:<?php echo "$find" ?></br>Name: <?php echo "$serviceName" ?>

        </h2>

        <div class="text-center" style="text-align:center;">
            <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="index.php" class="btn">Dashboard</a>
            <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="#middle2" class="btn">View</a>
        </div>
    </div>



    <div id="middle2">

        <div class='reviewbox' style="padding: 30px;">
         <!-- Service Details here using echo statement. Details pulled from sql database query css-->
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "  <div class='section-heading'>
                        <h1 style='font-size: 40px;' data-aos='fade-up' data-aos-duration='1000'data-aos-delay='400'><u>{$row["ServiceName"]}</u></h1>
                        </div>
                        <p style='font-size:20px;' data-aos='fade' 
                        data-aos-duration='1000' 
                        data-aos-delay='500'>URL: {$row['url']}
                        <br>Status: {$row['Status']}
                        <br>Since: {$row['TimeStamp']}
                        <br>User ID: {$row['userID']}
                        <br>Average Response time: $webResponse milliseconds 
                        <br>Average Ping time: $pingTime milliseconds 
                        <br>Average Page Load time: $pageLoad milliseconds 
                        </p>
                        </section>
                        <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href='#middle3' class='btn'>Click to View Graphs</a>
                        <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href='viewCorrectTest.php?info={$row['serviceID']}' class='btn'>View Test data</a>";
                }
            }
            ?>

        </div>

    </div>
 
    <div id="middle3" style="background-image: url('img/background.jpeg');
        color: #fff;
        height: 100vh;
        background-size: cover;
        background-position: center;
        text-align: center;
        font-family: sans-serif;">
        <h1 data-aos='fade' data-aos-duration='1000' data-aos-delay='500'>Chart Visualization</h1>


            <!-- Chart.js is used to create graph css-->

        <div data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' id="chart-container" style=" box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            border: 2px solid black;
            background-color:#fff;
            padding: 16px;
            display: inline-block;">
            <canvas id="graphCanvas"></canvas>
        </div>

        <!-- Chart.js is used to create graph css-->
        <div data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' id="chart-container2" style=" box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            border: 2px solid black;
            background-color:#fff;
            padding: 16px;
            display: inline-block;">
            <canvas id="graphCanvas2"></canvas>
        </div>
        <!-- Chart.js is used to create graph css-->
        <div data-aos='fade-up' data-aos-duration='1000' data-aos-delay='500' id="chart-container3" style=" box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            border: 2px solid black;
            background-color:#fff;
            padding: 16px;
            display: inline-block;">
            <canvas id="graphCanvas3"></canvas>

        </div>
        <div class="backButton" style="text-align:center;margin-bottom:20px;">
            <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="#main" class="btn">Back to Top of Page</a>
            <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="index.php" class="btn">Back to Dashboard</a>
        </div>




            <!-- Chart.js that uses json array from Data.php to create Page Load time Chart-->
        <script>
            $(document).ready(function() {
                showGraph();
            });


            function showGraph() {
                {
                    $.post("data.php",
                        function(data) {
                            console.log(data);
                            var name = [];
                            var marks = [];

                            for (var i in data) {
                                name.push(data[i].ServiceName);
                                marks.push(data[i].timeInMilliseconds);
                            }

                            var chartdata = {
                                labels: name,
                                datasets: [{
                                    label: 'Page Load Time (in milliseconds)',
                                    backgroundColor: '#49ffe7',
                                    borderColor: '#05b0b0',
                                    hoverBackgroundColor: '#fffafa',
                                    color: '#fcffff',
                                    hoverBorderColor: '#edebeb',
                                    data: marks
                                }]
                            };

                            var graphTarget = $("#graphCanvas");

                            var barGraph = new Chart(graphTarget, {
                                type: 'line',
                                data: chartdata
                            });
                        });
                }
            }
        </script>
        <!-- Chart.js that uses json array from Data2.php to create Web Response time Chart-->
        <script>
            $(document).ready(function() {
                showGraph2();
            });


            function showGraph2() {
                {
                    $.post("data2.php",
                        function(data) {
                            console.log(data);
                            var name = [];
                            var marks = [];

                            for (var i in data) {
                                name.push(data[i].ServiceName);
                                marks.push(data[i].timeInMilliseconds);
                            }

                            var chartdata = {
                                labels: name,
                                datasets: [{
                                    label: 'Web Response Time (in milliseconds)',
                                    backgroundColor: '#02bfe0',
                                    borderColor: '#000000',
                                    hoverBackgroundColor: '#52a7b3',
                                    color: '#fcffff',
                                    hoverBorderColor: '#edebeb',
                                    data: marks
                                }]
                            };

                            var graphTarget = $("#graphCanvas2");

                            var barGraph = new Chart(graphTarget, {
                                type: 'bar',
                                data: chartdata
                            });
                        });
                }
            }
        </script>
        <!-- Chart.js that uses json array from Data3.php to create Average Ping time Chart-->
        <script>
            $(document).ready(function() {
                showGraph3();
            });


            function showGraph3() {
                {
                    $.post("data3.php",
                        function(data) {
                            console.log(data);
                            var name = [];
                            var marks = [];

                            for (var i in data) {
                                name.push(data[i].ServiceName);
                                marks.push(data[i].timeInMilliseconds);
                            }

                            var chartdata = {
                                labels: name,
                                datasets: [{
                                    label: 'Average Ping Time (in milliseconds)',
                                    borderColor: '#3402b3',
                                    hoverBackgroundColor: '#fffafa',
                                    color: '#fcffff',
                                    hoverBorderColor: '#edebeb',
                                    data: marks
                                }]
                            };

                            var graphTarget = $("#graphCanvas3");

                            var barGraph = new Chart(graphTarget, {
                                type: 'line',
                                data: chartdata
                            });
                        });
                }
            }
        </script>

    </div>




    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>

</html>