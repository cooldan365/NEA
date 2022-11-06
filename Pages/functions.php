<?php

function emptyInputSignup($usrname,$password,$rpeatpass) {
    $result;
    if (empty($usrname) || empty($password) || empty($rpeatpass)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function invalidUid($usrname) {
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $usrname)) {
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

function uidExists($conn , $usrname) {
    $sql = "SELECT * FROM users WHERE usersUid = ? ;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: index.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s",$usrname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

function pwd6($conn, $password){
    if ($password >= 6){
        $result = true;
    }
    else{
        $result = false;
        return $result;
    }
}

function createUser($conn, $usrname, $password) {
    $sql = "INSERT INTO users (usersUid,usersPwd) VALUES (?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: index.php?error=stmtfailed");
        exit();
    }
    $hashedPwd = password_hash($password,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"ss",$usrname,$hashedPwd );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: index.php?error=none");
    exit();
}

function emptyInputLogin($username,$password){
    $result;
    if (empty($username) || empty($password)){
        $result = true;
    }
    else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $usrname, $password){
    $uidExists = uidExists($conn,$usrname);

    if($uidExists === false){
        header("location: logup.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["usersPwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: logup.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd === true){
        session_start();
        $_SESSION["userid"] =  $uidExists["usersId"];
        $_SESSION["uid"] =  $uidExists["usersUid"];
        header("location: mainhub.php?");
        exit();

    }
}
