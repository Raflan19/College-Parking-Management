<?php
 include("dbconn.php");
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header class="header">
        <div class="logoname">
            <h3>ParkEasy.</h3>
        </div>
        <nav class="links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li>
                <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
                    <a href="parkmap.php">Park-map</a>
                <?php else:?>
                    <a href="login.html">Park-map</a>
                <?php endif; ?>
                </li>
                <li>
                <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
                    <a href="bookhistory.php">Your-slots</a>
                <?php else:?>
                <a href="login.html">Your-slots</a></li>
                <?php endif; ?>
                </li>
            </ul>
        </nav>
        <div class="logsignup" id="logsignup">
           <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
            <span><?php echo '😎'.htmlspecialchars($_SESSION["username"])?></span>
            <button><a href="logout.php">Logout</a></button>
           <?php else:?>
            <a href="login.html" id="log">Login</a>
            <button><a href="signup.html"> Register</a></button>
           <?php endif; ?>
        </div>
     </header>

 <div class="main">
   <div class="leftone">
   </div>

   <div class="rightone">
    <span>Effortless parking</span><br><span>at your </span><span style="font-style: italic;">fingertips</span><br>
    <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
        <button class="bookyours"><a href="parkmap.php"> Check Slots</a></button>
    <?php else:?>
        <button class="bookyours"><a href="login.html"> Check Slots</a></button>
    <?php endif; ?>
   </div>
 </div>
</body>
</html>

