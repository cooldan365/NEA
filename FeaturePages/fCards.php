<?php

//gets the session details which are in the XAMPP serveer
session_start();
$usrname = $_SESSION['uid'];
//created a flashcard class so that I can find the different flashcard sets.
class Flashcards
{
    public $set_location;

    public function __construct($usrname)
    {
        //finds the path to the files and 
        $this->set_location = $_SERVER['DOCUMENT_ROOT']. "/NEA/flashcardcsv";
        $this->usrname = $usrname;
    }
    public function displayUnits()
    {
        //finds the files in the local directory
        $dir = $this->set_location;
        $files=scandir($dir);
        //for each file found in the directory, it will skip the loop
        foreach ($files as $key => $value) {
            if ($value != '.' && $value != '..') {
                $value = str_replace('.csv', '', $value);
                $value = str_replace('.txt', '', $value);
                //when displaying the different flashcards, the program will remove the .csv or .txt
                echo '<a href = "StudyPage.php?set=' . $value . '"><div id="unit">' . $value . '</div></a>';
                //displays the sets on the screen 
            }
        }
    }

}
$userS = new Flashcards($usrname);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studify</title>
    <link rel="stylesheet" href="../styles/FCards.css"> 
</head>
<body>
<div class="title"> Flashcard Sets:</div>    
<div class="container"> 
    <div class="t">
        <?php
            //calls the function in the class to display units found 
            $userS->displayUnits();
        ?>
    </div>
</div>  
</body>
</html>

