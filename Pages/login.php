<?php

if(isset($_POST["submit"])){
    $usrname = $_POST["uid"];
    $password = $_POST["pass"];

    require_once 'dbh.php';
    require_once 'functions.php';

    if(emptyInputLogin($usrname,$password) !== false){
        header("location: logup.php?error=emptyinput");
        exit();
    }
    loginUser($conn,$username,$password);
}
else{
    header("Location:logup.php");
}   
