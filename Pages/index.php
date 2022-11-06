<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studify</title>
    <link rel="stylesheet" href="../styles/logsin.css">
</head>
<body>
    <div class="container">
       
    <div class="images"> <!--created a class so that I can manipulate the logo in my css document -->
        <img src="../images/homepagelogo.PNG" alt=""> 
    </div>
    <div class = "buttons">
        <h1 class="ttle">Choose an Option...</h1>
        <a href="sup.php" class="btn1"> <!--creates a link to the signup page if the user clicks the sign up button-->
            SignUp
        </a>
        <a href="logup.php" class="btn2"> <!--creates a link to the login page if the user clicks the login button -->
            Login
        </a>
    </div>
    </div>
</body>
</html>

<?php
    if(isset($_SESSION["usersuid"])){
        echo "<li><a href='mainhub.php'></a><li>";
        echo "<li><a href='logout.php'></a><li>";
    }
    else{
        echo "<li><a href='logup.php'></a><li>";
        echo "<li><a href='sup.php'></a><li>";
    }
?>
