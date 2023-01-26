<?php
//all of these subroutines get their paramaters which are passed by value from signup.php 
function emptyInputSignup($usrname,$password,$rpeatpass) {    
    $result; 
    if (empty($usrname) || empty($password) || empty($rpeatpass)){  //empty is a pre built function in php which checks for empty input
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

//each subroutine returns a value to signup.php which echos the error in the users input.

function invalidUid($usrname) {  //checks for invalid username
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $usrname)) {   //conditions for what values can be in the username, in this case is any letters and valeus from 0-9
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function pwdMatch($password,$rpeatpass) {
    $result;
    if ($password !== $rpeatpass) {
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}
 
function uidExists($conn , $usrname) {   //$conn is the variable that creates a connection to the database, $usrname is then passed into the database 
    $sql = "SELECT * FROM users WHERE usersUid = ? ;";   //SQL to select all in values in the database and compare it to usrname which we defined usersUid in signup.php
    $stmt = mysqli_stmt_init($conn);  //initialises a connection to the database
    if(!mysqli_stmt_prepare($stmt,$sql)) {  //condition to check wether any values selected in $SQL are prese
        header("location: index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$usrname); //takes in the statement and the ? in the statemnet above becomes the username inputted 
    mysqli_stmt_execute($stmt);  //executes the statement 

    $resultData = mysqli_stmt_get_result($stmt); 
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt); //closes the connection once done 
}

function pwd6($password){ //checks wether the user has inputted a valid password
    if (strlen($password) <= 6){
        $result = true;
        header("location: sup.php?error=pass2short");
        exit();
    }
    else{
        $result = false;
        return $result;
    }
}

function createUser($conn, $usrname, $password) {  //once the userinput has gone through all of these checks, and theres no errors, this function creates their account
    $sql = "INSERT INTO users (usersUid,usersPwd) VALUES (?,?);"; //SQL statement to insert the usrname and password into the database
    $stmt = mysqli_stmt_init($conn); //initialises the server connection
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($password,PASSWORD_DEFAULT); //hashes the password in the database so it is safely stored

    mysqli_stmt_bind_param($stmt,"ss",$usrname,$hashedPwd ); //prepares to insert the following parameters in the database, the "ss" indicates im inserting only two strings in the database
    mysqli_stmt_execute($stmt);//inputs all data into the database
    mysqli_stmt_close($stmt);
    header("location: mainhub.php");
    exit();
}

function emptyInputLogin($usrname,$password){ //takes the input from emptyInputLogin in logup.php and checks if there is any empty inputs 
    $result;
    if (empty($usrname) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $usrname, $password){  //if there are no empty fields, user will be directed here which performs error handling
    $uidExists = uidExists($conn,$usrname);

    if($uidExists === false){  //checks if the username exists
        header("location: logup.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){  //if the password is not the same as the one in the database, it will tell the user to reenter input 
        header("location: logup.php?error=wronglogin"); 
        exit();
    }
    else if ($checkPwd === true){ //if there are no errors, user will be able to log on
        session_start(); //starts a session with the folowing user details
        $_SESSION["userid"] =  $uidExists["usersId"];
        $_SESSION["uid"] =  $uidExists["usersUid"];
        header("location: mainhub.php?");
        exit();

    }
}
