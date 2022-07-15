<?php
 //Page that displays the bandwidth tests for the specificed service using Service ID
if (isset($_GET['info'])) {
    $find = $_GET['info'];
    include("config/conn.php");
    $sql3 = "SELECT * FROM argus_bandwithTests WHERE serviceID =$find;";
    $result1 = $conn->query($sql3);
    if (!$result1) {
        echo $conn->error;
    }

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) {
            $newKB = $row['kb'];
            $newDuration = $row['duration'];
            $newSpeed = $row['speed'];
            $mbSpeed = $newSpeed / 1000;
            $newMbSpeed = sprintf('%.3f', $mbSpeed);
        }
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


    <style>
        .container {
            width: 100%;
            height: 90%;
            color: white;
        }
    </style>
    <script src="js/Chart1.js"></script>
    <script src="js/Gauge.js"></script>
    <title>Chart</title>
</head>


<body>

    <header>

        <div id="main" style="color:white;">
            <div class="logo" data-aos='fade' data-aos-duration='1000' data-aos-delay='500'>
                <h1>ARGUS</h1>
            </div>
            <ul data-aos='fade' data-aos-duration='1000' data-aos-delay='500'>
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="services.php">Services</a></li>
                <li><a href="logout.php">Sign Out</a></li>

            </ul>
            <div class="title" style="color:white;margin-top:30px;font-size:30px;">
                <h1 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 30px; font-family: sans-serif;text-align:center;">
                    Bandwidth Test of Service ID: <?php echo "$find" ?></h1>
                <h2 data-aos='fade' data-aos-duration='1000' data-aos-delay='500' style="color: white;font-size: 30px; font-family: sans-serif;text-align:center;">
                    Streamed 1024 Kb<br>Duration in seconds: <?php echo "$newDuration" ?><br>Below is your bandwidth in Mb/s</h2>
                <div class="button" style="text-align:center;">
                    <a data-aos='fade' data-aos-duration='1000' data-aos-delay='500' href="correctTest.php" class="btn">Back</a>

                </div>

                <div class="container">

                    <div class="row" allign="center">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>





    </header>


        <!--Javascript that takes the Bandwidth metric produced from the Bandwidth Test and displays it -->
        <!--Converts the variable into a figure to be displayed as a gauge meter -->
    <script type="text/javascript">
        var ctx = document.getElementById("canvas").getContext("2d");
        var myVariable = <?php echo (json_encode($newMbSpeed)); ?>;
        new Chart(ctx, {
            type: "tsgauge",
            data: {
                datasets: [{
                    backgroundColor: ['#006666', '#66ffcc', '#006666', '#009999', '#66ffcc', '#99ffcc', ' #e6ffe6', '#99ffcc'],
                    borderWidth: 0,
                    gaugeData: {
                        value: myVariable,
                        valueColor: "#ffffff"
                    },
                    gaugeLimits: [0, 25, 50, 75, 100, 125, 150, 175, 200]
                }]
            },
            options: {
                events: [],
                showMarkers: true
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>