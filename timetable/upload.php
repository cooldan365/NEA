<?php
if(isset($_FILES['file']) && !empty($_FILES['file']['tmp_name'])) {
    $file = $_FILES['file'];
    $file_name = $_POST['filename'];
    $file_location = $_POST['file_location'];
    $file_path = $file_location . $file_name;

    if(move_uploaded_file($file['tmp_name'], $file_path)) {
        echo "File uploaded successfully.";
    } else {
        echo "Failed to upload the file.";
    }
}
?>
