<?php

if(isset($_POST["submit"])){ //checks if the user has got to this stage by pressing the submit button on the logup.php
    $usrname = $_POST["uid"]; //takes the variable uid in logup.php and assigns it to $usrname
    $password = $_POST["pass"]; //takes the variable pass in logup.php and assigns it to $password

    require_once 'dbh.php'; //calls these two programs so that they can compare iinput and perform error checks
    require_once 'functions.php';

    if(emptyInputLogin($usrname,$password) !== false){  //takes the input and passes it by value to the coresponding function in functions.php and then checks wether the return from function.php is !=false
        header("location: logup.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$usrname,$password);
}
else{
    header("Location:logup.php");
}   
