<?php
session_start(); 
$usrname = $_SESSION['uid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/aFeatures.css">
</head>
<body>
    <div class="php">
    <?php
        echo 'Welcome To the Additional Features;  ' . $usrname . ' !'; //displays the username in the current session 
    ?>
    </div>
<div class="container">    
    <div class="left">
        <a class = "clock" href="clock.html">Clock</a>
    </div>
    <div class="middle">
        <a class = "file" href="fileupload.php">File/Link Upload</a>
    </div>
    <div class="right">
        <a class= "tTable" href="../timetable/timetable.php">TimeTable:</a></div>
    </div>    
</body>
</html>