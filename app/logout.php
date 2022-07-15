<?php

//Login.php which will terminate the session variable, signing the user out
session_start(); //to ensure you are using same session
session_destroy();
header('Location: index.php');
?>