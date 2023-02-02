<?php
// gets already stored data from the program and displays it
session_start();  
$usrname = $_SESSION['uid'];
$set = $_GET['set'];
//creates a path in the program to the files that store the created sets.
if (($open = fopen($_SERVER['DOCUMENT_ROOT'] . '/Nea/flashcardcsv/' . $set  . '.csv', "r")) !== FALSE) {
//opens the sets in read mode 
    while (($data = fgetcsv($open, 100, ",")) !== FALSE) {
        //the purpose of 100 is so that there is a limit to how many lines the program reads of the file
        //I have set it to 100 so that the program does not crash 
        $array[] = $data;
    }
    //closes the file 
    fclose($open);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- linking the JavaScipt file so various functions can be performed -->
    <script src="../Scripts/studypage.js" defer></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studify</title>
    <link rel="stylesheet" href="../styles/flashcard.css">
</head>
<body>  
        <!--Instead of creating classes, I have id's, this is because  -->
        <!--JS only reads ID's and not classes when taking in the data from html  -->
        <div id="invisible">
            <?php
                echo json_encode($array);
            ?>
        </div>
        <div class="container">
            <div id="card">
                <div id="question">
                </div>
                <div class="hidenA"id="answer">
                </div>
            </div>   
            <div class="btncontainer">
                <div id="buttons">
                    <div id="correct">
                        <button id="correct-btn" onclick="toggleCorrect()">
                            Correct
                        </button>
                    </div>
                    <div id="incorrect">
                        <button id="incorrect-btn" onclick="toggleIncorrect()">
                            Incorrect
                        </button>
                    </div>
                </div>
            </div>
            <div id="flip">
                <button id="flip" onclick="showAnswer()">
                    Show Answer
                </button>
            </div>
            </div>
        <!-- In this div,I have created a button which takes all the data 
        that has been calculated in the prgram, such as score and endC
        and passes it into handler.php page -->
        <div id="splash" class="nonvisible">
            <form action="handler.php" method="POST">
                <input type="hidden" id="score-input" name="score" value="">
                <input type="hidden" id="endC-input" name="endC" value="">
                <h1 class="steps">Click submit to continue:</h1>
                <button id="sub" type="input">Submit</button>
            </form>
        </div>
</body> 
</html>
