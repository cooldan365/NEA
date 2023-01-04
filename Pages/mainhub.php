<?php
session_start(); //indicates to the algortuhmsthat any data associated with this account should be taken
$usrname = $_SESSION['uid']; //to display the users name, I would need to go into the XAMPP server 'session' and take the username from the database so it can be displayed
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Studify</title>
        <link rel="stylesheet" href="../styles/mainpage.css">   
</head>
    <body>    
    <div class="welcome">
        <?php
        echo 'Welcome Back;  ' . $usrname . ' !'; //displays the username in the current session 
        ?>
    </div>
    <div class="txt">
        <p>Please select where you would like to be directed</p>
    </div>
    <div class="container">
        <div class="left">
            <a href="../FeaturePages/fCards.php" class="fCards">Flashcards</a>
        </div>
        <div class="right">
            <a href="../FeaturePages/aFeatures.php" class="aFeatures">Additional Features</a>
        </div>
    </div>
    <div class="middle">
        <a href="../FeaturePages/pTracker.php" class="pTrack">Progress Tracker</a>
    </div>  
</body>
</html>
</html>
