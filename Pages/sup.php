<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studify</title>
    <link rel="stylesheet" href="../styles/signup.css">
</head>
<body>
    <div class="images">
        <img src="../images/LoginPageLogo.PNG" alt="">
    </div>
    <div class="container">
        <h2>Please enter your details...</h2>
        <form action="signup.php" method="post">
        <h1>Username</h1>    
        <input class="userN" type="text" name="uid" placeholder="UserName....">
            <!--created a form which allows user to input their username!-->
        <h1>Password</h2>
        <input class="pass"type="password" name="pass" placeholder="Password...">
        <!--created a form which allows the user to input their password,            
        additionally, when type=password, it provides security for the user as it hides the password with dots!-->
        <h1 class="Rp">Repeat Password</h1>
        <input class= "pass2" type="password" name="pass1" placeholder="Confirm Password...">
        <button class = "btn" type="submit" name="submit">Sign Up</button>
        </form>
        <div class="errorm">
        <?php
            if (isset($_GET["error"])){  //Error display message 
                if($_GET["error"] == "emptyinput") {       //the command _GET is a function in php  which goes into the URL of the webage and searches for a particular statement, in this case it is searching for the word error, once it finds the error it will run the if's staements and display the according message to the user
                    echo "<p> Fill in all fields!</p>";  
                }                                        
                else if ($_GET["error"] == "invaliduid"){
                    echo "<p> Choose a proper Username!</p>";
                }
                else if ($_GET["error"] == "usernametaken"){
                    echo "<p>This username has already been taken!</p>";
                }
                else if ($_GET["error"] == "pass2short" ){
                    echo "<p>Password too short!</p>";
                }
                else if ($_GET["error"] == "passwordsdontmatch" ){
                    echo "<p>Password's do not match!</p>";
                }
                else if ($_GET["error"] == "stmtfailed" ){
                    echo "<p>Unexpected Error!</p>";
                }
                else if ($_GET["error"] == "pass2short" ){
                    echo "<p>Password must be greater than 6!</p>";
                }
                else if ($_GET["error"] == "none"){
                    echo "<p>You have signed up</p>"; //if there are no errors, then the user will be directed to another page however this is shown in another backend part
                }
            }   
            ?>
        </div>
    </div>
</body>
</html>