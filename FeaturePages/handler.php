<?php
    session_start();
    $usrname = $_SESSION['uid'];
    //grabs the score from the URL and passes it into the variables 
    //raw scores and endC.
    $rawScore = $_POST['score'];
    $endC = $_POST['endC'];
    //to avoild a 0 error division, i set the if statement to run only if 
    //the raw score was greater than 0, if not, then the percentage is 0
    //intval is a function in php which converts a string into integers
    if (intval($rawScore) > 0 && intval($endC) > 0) {
        $percentage = intval($rawScore) / intval($endC) * 100;
        //in the parameters, the 2 states that it should be rounded to 2 decimal
        //places
        $percentage = round($percentage, 2);
    } else {
        $percentage = 0;
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flashcard, Score</title>
    <link rel="stylesheet" href="../styles/handler.css">
</head>
<body>
    <div class="all">
        <div class="welcome">
            <?php
            echo 'You have Successfully completed the set ;  ' . $usrname . ' !'; //displays the username in the current session 
            ?>
        </div>
        <div class="container">
            <div class="actualScore">
                <?php
                //for every different percentage bracket, I have created different messages.
                    if ($percentage == 100) {
                        echo "<span class='excellent'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . " Excellent!" . "</span>";
                    } elseif ($percentage > 90 && $percentage < 99) {
                        echo "<span class='verygood'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . " Very Good!" . "</span>";
                    } elseif ($percentage > 50) {
                        echo "<span class='good'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . " Good!" . "</span>";
                    } elseif ($percentage < 50) {
                        echo "<span class='couldbebetter'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . " Could be better!" . "</span>";
                    } elseif ($percentage < 20 && $percentage > 1) {
                        echo "<span class='needsimprovement'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . " Needs improvement!" . "</span>";
                    } else {
                        echo "<span class='default'>" . "Your raw score is " . $rawScore . " and your percentage is " . $percentage . "%" . "</span>";
                    }
                ?>
            </div>
            <div class="content">
                <div class="individual">
                    <?php
                    echo "Total Number of Flashcards: " . $endC . "<br>";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>