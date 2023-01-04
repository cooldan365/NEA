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