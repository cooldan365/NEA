<?php

// Check that the required POST parameters are present
if (isset($_POST['csv_string']) && isset($_POST['filename'])) {
    // Get the CSV string and filename from the POST parameters
    $csvString = $_POST['csv_string'];
    $filename = $_POST['filename'];
    
    // Ensure that the filename is safe to use
    $filename = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "", $filename);
    
    // Save the CSV string to a file on the server
    $file = fopen("timetables/" . $filename . ".csv", "w");
    fwrite($file, $csvString);
    fclose($file);
}

?>