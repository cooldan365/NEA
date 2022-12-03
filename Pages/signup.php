<?php

if(isset($_POST["submit"])) { //this if staement does a check to ensure the user has pressed the submit button which will direct them here
    
    $usrname = $_POST["uid"];
    $password = $_POST["pass"];
    $rpeatpass = $_POST["pass1"];

    //above I have created the variables which will be passed in the program to run error checks

    require_once 'dbh.php';         //links this file with my database file to pass variables or connect to the database and perform error handling checks
    require_once 'functions.php';  //when the variables above have been assigned, they will be passed to the error handling pages so that they can be checked

    if(emptyInputSignup($usrname,$password,$rpeatpass) !== false){  //if the function in functions.php returns !=false, then the url will have the "sup.php?error=emptyinput""
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
    if(uidExists($conn,$usrname)!= false){  //these paramaters are passed to the functions.php and the $conn a direct connection to the database 
        header("location: sup.php?error=usernametaken"); //url will be changed so that the error message can be disblayed in sup.php
        exit();
    } 
    if(pwd6($password) != true){
        header("location: sup.php?error=pass2short");
    }

    createUser($conn,$usrname,$password);
    header("location: ttQ.php"); 
    exit();
}

else{
    header("location: index.php"); //if the user had not pressed the submit button to get to this stage, they will be returned to the index page
    exit();
}
