<?php
session_start();
$usrname = $_SESSION['uid'];

//creating a connection between the user and adding variables into the database
if (isset($_POST['day']) && isset($_POST['activity']) && isset($_POST['time']) && isset($_POST['user_id'])) {
    // Retrieve form data
    $day = $_POST['day'];
    $activity = $_POST['activity'];
    $time = $_POST['time'];
    $user_id = $_POST['usrname'];

    // Connect to MySQL database
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "timetable";

    $conn = mysqli_connect($host, $user, $password, $dbname);

    // PHP script to process the form submission and store the data in a MySQL database
    $sql = "INSERT INTO timetable (day, activity, time, user_id) VALUES ('$day', '$activity', '$time', '$user_id')";
    mysqli_query($conn, $sql);

    // Close connection
    mysqli_close($conn);
}
?>