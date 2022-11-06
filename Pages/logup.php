<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studify</title>
    <link rel="stylesheet" href="login.css">    
</head>
<body>
    <div class="container">
        <h2>Login</h2>
    <form action="login.php" method="post">
            <input  type="text" name="uid" placeholder="UserName...."> 
            <input  type="password" name="pass" placeholder="Password...">
            <button type="submit" name="submit">Login</button>
        </form>
        <?php
            if (isset($_GET["error"])){  //Error display message
                if($_GET["error"] == "emptyinput") {
                    echo "<p> Fill in all fields!</p>";
                }
                else if ($_GET["error"] == "wronglogin"){
                    echo "<p>Incorrect Login Details!</p>";
                }
              }   
        ?>
    </div>
    
</body>
</html>