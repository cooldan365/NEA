<?php

// Check that the required GET parameter is present
if (isset($_GET['filename'])) {
    // Get the filename from the GET parameter
    $filename = $_GET['filename'];
    
    // Ensure that the filename is safe to use
    $filename = preg_replace("/[^a-zA-Z0-9\.\_\-]/", "", $filename);
    
    // Check if the file exists
    if (file_exists("timetables/" . $filename . ".csv")) {
        // Read the contents of the file into a string
        $csvString = file_get_contents("timetables/" . $filename . ".csv");
        
        // Return the CSV string to the client
        echo $csvString;
    } else {
        // Return an error message if the file does not exist
        echo "Error: File not found";
    }
}

?>