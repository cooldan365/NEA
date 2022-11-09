<?php

if(isset($_POST["submit"])) {
    
    $usrname = $_POST["uid"];
    $password = $_POST["pass"];
    $rpeatpass = $_POST["pass1"];

    require_once 'dbh.php';
    require_once 'functions.php';

    if(emptyInputSignup($usrname,$password,$rpeatpass) !== false){
        header("location: sup.php?error=emptyinput");
        exit();
    }

    if(invalidUID($usrname) != false){
        header("location: sup.php?error=invaliduid");
        exit();
    }
    if(pwdMatch($password,$rpeatpass) != false){
        header("location: sup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn,$usrname)!= false){
        header("location: sup.php?error=usernametaken");
        exit();
    } 
    if(pwd6($password) != true){
        header("location: sup.php?error=pass2short");
    }

    createUser($conn,$usrname,$password);
    
}

else{
    header("location: index.php");
    exit();
}
