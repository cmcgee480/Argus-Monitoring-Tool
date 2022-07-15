<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <style>
    .progress {
      position: relative;
      width: 210px;
      height: 30px;
      background: grey;
      border-radius: 5px;
      overflow: hidden;
    }

    .progress_fill {
      width: 50%;
      height: 100%;
      background: lightgreen;
    }

    .progress_text {
      position: absolute;
      top:50%;
      right:5px;
      transform:translateY(-50%);
      font: bold 14px 'Quicksand',sans-serif;
      color:white;
    }
  </style>
</head>



<div class="progress">
  <div class="progress_fill"style="width:30%;"></div>
  <span class="progress_text">40%</span>
</div>

</html>