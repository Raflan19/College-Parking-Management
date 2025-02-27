<?php
 include("dbconn.php");
 session_start();
 if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['resid'])) {
    $resID = $_GET['resid'];
    $sql_delete = "DELETE FROM reservationdetails WHERE resid = '$resID'";
    mysqli_query($conn, $sql_delete);
    // Redirect back to user list after deletion
    header("Location: bookhistory.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/bookhistory.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Booked History</title>
</head>
<body>
    <header class="header">
        <div class="logoname">
            <h3>ParkEasy.</h3>
        </div>
        <nav class="links">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="parkmap.php">Parkmap</a></li>
                <li><a href="bookhistory.php">Booking</a></li>
            </ul>
        </nav>
        <div class="logsignup" id="logsignup">
           <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
            <span><?php echo '😎'.htmlspecialchars($_SESSION["username"])?></span>
            <button><a href="logout.php"> Logout</a></button>
           <?php else:?>
            <a href="login.html" id="log">Login</a>
            <button><a href="signup.html"> Register</a></button>
           <?php endif; ?>
        </div>
     </header>

    <div class="history-table">
        <table>
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Slot No.</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
             if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true){
              $username=$_SESSION["username"];
              $sql="SELECT resid,slotno,starttime,endtime,slotdate FROM reservationdetails WHERE username='$username'";
              try{
              $res=$conn->query($sql);
              }
              catch(mysqli_sql_exception){
                echo "connection error";
              }
              $slno=1;
              if($res->num_rows>0){
                while($items=$res->fetch_assoc()){
                    echo"<tr><td>$slno</td><td>{$items["slotno"]}</td><td>{$items["starttime"]}</td><td>{$items["endtime"]}</td><td>{$items["slotdate"]}</td><td><a href='bookhistory.php?action=delete&resid=" . $items['resid'] . "' class='status-cancelled' id='cancelbtn'>Cancel</a></td></tr>";
                    $slno+=1;
                }
              }
              else{
                echo "<tr><td colspan='6'>Nothing to show here</td>";
              }
            }
            else{
                echo "<tr><td colspan='6'>Nothing to show here</td>";
            }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
