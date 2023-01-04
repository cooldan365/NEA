<?php
session_start(); // Start a new session or resume an existing one
$name = $_SESSION['uid'];
echo $name;

// Check if the file was uploaded
if(isset($_FILES['file'])) {
    if($_FILES['file']['error'] > 0) {
        echo '<div class = "error">';
        echo 'Error:  "No file uploaded" <br>';
        echo '</div>';

    } else {
        // Get the uploaded file
        $file = $_FILES['file'];

        // Get the file name and extension
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        // Allow certain file formats
        $allowed_extensions = array("jpg", "jpeg", "png", "pdf","txt","csv");
        if(in_array($file_ext, $allowed_extensions)) {
            // Check if the definedName key is set and has a non-empty value
            if(isset($_POST['definedName']) && !empty($_POST['definedName'])) {
                $file_name_new = $name . $_POST['definedName'] . '.' . $file_ext;
            } else {
                // Set a default file name if the definedName key is not set
                $file_name_new = $name . 'default' . '.' . $file_ext;
            }

            // Set the file destination
            $file_destination = '../fileupload/' . $file_name_new;

            // Move the file to the destination
            move_uploaded_file($file_tmp, $file_destination);
        }
    }
}

// Delete a file if the delete button was clicked
if(isset($_POST['delete'])) {
    $file_to_delete = '../fileupload/' . $_POST['delete'];
    if(file_exists($file_to_delete)) {
        unlink($file_to_delete);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload, Studify</title>
</head>
<body>
    <form action="fileupload.php" method="post" enctype="multipart/form-data">
        <label for="file">Select a file to upload:</label>
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload" name="submit">
        <div class="fName">
            <label for="definedName">Please give the file a name</label>
            <input class="defName" type="text" name="definedName" id="definedName">
        </div>
        <div class="uploaded-files">
            <?php
            $uploaded_files = array_diff(scandir('../fileupload/'), array('.', '..'));
            foreach($uploaded_files as $uploaded_file) {
                $username_start = strpos($uploaded_file, $name);
                if($username_start === 0) {
                    echo '<a href="../fileupload/' . $uploaded_file . '" target="_blank">' . $uploaded_file . '</a>';
                    echo '<form action="fileupload.php" method="post" style="display: inline;">';
                    echo '<input type="hidden" name="delete" value="' . $uploaded_file . '">';
                    echo '<input type="submit" value="Delete">';
                    echo '</form>';
                    echo '<br>';
                }
            }
            ?>
        </div>
    </form>
    </div>
</body>
</html>
