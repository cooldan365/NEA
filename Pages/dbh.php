<?php
$serverName = "localhost";  //tells the xampp server to use my locaalhost as a server runner
$dBUsername = "root"; 
$dBPassword = "";
$dBName = "userdata"; //name of the database I input and get data from 

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dBName); //as I am using xampp as my server runner, I have passed this information into it so I am able to connect my program to the mysqli database.

if(!$conn){  
    die("Connection Failed" . mysqli_connect_error()); //if there is an error, the "mysqli_connect_error" which is an inbuilt function will display the error 

}