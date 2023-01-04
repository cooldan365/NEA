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

//this function is to now display the data inside timetable:
// Connect to MySQL database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "timetable";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Retrieve all rows from timetable table for logged-in user
$user_id = $_SESSION['usrname'];
$sql = "SELECT * FROM timetable WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

// Display timetable in HTML table
echo "<table>";
echo "<tr><th>Day</th><th>Activity</th><th>Time</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    $day = $row['day'];
    $activity = $row['activity'];
    $time = $row['time'];
    echo "<tr><td>$day</td><td>$activity</td><td>$time</td></tr>";
}
echo "</table>";

// Close connection
mysqli_close($conn);

// Add link to timetable page
echo "<br><a href='timetable.php'>View Timetable</a>";

// Display message indicating activity has been added
if (isset($_POST['day']) && isset($_POST['activity']) && isset($_POST['time'])) {
    echo "<br>Activity added to timetable.";
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="">
    <script src="../Scripts/tTable.js" defer></script>
</head>
<body>
<form id="timetable-form">
    <label for="day">Day:</label><br>
    <select name="day" id="day">
        <option value="Monday">Monday</option>
        <option value="Tuesday">Tuesday</option>
        <option value="Wednesday">Wednesday</option>
        <option value="Thursday">Thursday</option>
        <option value="Friday">Friday</option>
        <option value="Saturday">Saturday</option>
        <option value="Sunday">Sunday</option>
    </select><br>
    <label for="activity">Activity:</label><br>
    <input type="text" name="activity" id="activity"><br>
    <label for="time">Time:</label><br>
    <input type="text" name="time" id="time"><br><br>
    <input type="button" value="Add" onclick="addActivity()">
</form>
</body>