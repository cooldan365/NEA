<?php
session_start(); // Start a new session or resume an existing one
$name = $_SESSION['uid'];
// Check if the file was uploaded
if(isset($_FILES['file'])) {
    //error function is the file upload doesnt work, with the apppropriate error message
    if($_FILES['file']['error'] > 0) {
        echo '<div class = "error">';
        echo 'Error:  "No file uploaded" <br>';
        echo '</div>';

    } else {
        // Get the uploaded files
        $file = $_FILES['file'];

        // this function splits the uploaded file name into different parts
        //such as the extention of the file.csv,pdf and adds the username of the person to the file name
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        // varibale $allowed is used to ensure that there are certain files 
        //file types the user is uploading
        $allowed_extensions = array("jpg", "jpeg", "png", "pdf","txt","csv");
        if(in_array($file_ext, $allowed_extensions)) {
            // Check if the definedName key is set and has a non-empty value
            if(isset($_POST['definedName']) && !empty($_POST['definedName'])) {
                $file_name_new = $name . $_POST['definedName'] . '.' . $file_ext;
            } else {
                // Set a default file name if the definedName key is not set and is then saved
                $file_name_new = $name . 'default' . '.' . $file_ext;
            }

            // Set the file destination of where the file should be stored
            //with the correct file name to identify it 
            $file_destination = '../fileupload/' . $file_name_new;

            // Move the file to the destination
            move_uploaded_file($file_tmp, $file_destination);
        }
    }
}

//function to delete the files displayed on the website
if(isset($_POST['delete'])) {
    //if there is a delete request, the program goes to the place where the user files are located
    // and deletes them
    $file_to_delete = '../fileupload/' . $_POST['delete'];
    if(file_exists($file_to_delete)) {
        //php fnction that permenantly deletees files
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
    <link rel="stylesheet" href="../styles/fileUpload.css">
</head>
<body>
    <div class="welcome">
        <?php
            echo $name;
        ?>
    </div>
    <form class="content" action="fileupload.php" method="post" enctype="multipart/form-data">
        <label  class="text" for="file">Select a file to upload:</label>
        <input class="fileU" type="file" name="file" id="file">
        <input class="S"type="submit" value="Upload" name="submit">
        <div class="fName">
            <label class="text" for="definedName">Please give the file a name</label>
            <input class="defName" type="text" name="definedName" id="definedName">
        </div>
    </form>
    <!-- form which allows for the file upload to occur -->
    <div class="uploaded-files">
            <?php
            // scans the local desktop for the fileupload folder
            $uploaded_files = array_diff(scandir('../fileupload/'), array('.', '..'));
            //starts a loop to search for each uploade file in the folder
            foreach($uploaded_files as $uploaded_file) {
                //compares the useranem of the current session and the one in the uploaded file
                $username_start = strpos($uploaded_file, $name);
                if($username_start === 0) {
                    //displays the files bound to that specific username:
                    echo '<a href="../fileupload/' . $uploaded_file . '" target="_blank">' . $uploaded_file . '</a>';
                    echo '<form action="fileupload.php" method="post" style="display: inline;">';
                    //delete function for any file uploaded 
                    echo '<input type="hidden" name="delete" value="' . $uploaded_file . '"class="D">';
                    echo '<input  type="submit" value="Delete">';
                    echo '</form>';
                    echo '<br>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>

