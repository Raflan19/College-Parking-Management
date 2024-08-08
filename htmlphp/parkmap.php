<?php
 include("dbconn.php");
 session_start();

 date_default_timezone_set('Asia/Kolkata');
 $current_time = strtotime(date('H:i:s'));
 $midnight = strtotime('00:00:00');
 $eightam=strtotime('08:00:00');
 
 //refreshDB after 12 am
 if($current_time>=$midnight&&$current_time<=$eightam){
    $sql="DELETE FROM reservationdetails";
    $res=mysqli_query($conn,$sql);
 }

 

 //Booking to be made open only after 8 am
if ($current_time < $eightam) {
    echo "<script>
    if (confirm('Bookings are open after 8 am IST. Please try again later.')) {
        window.location.href = 'index.php';
    } else {
        window.location.href = 'index.php'; // Fallback redirect if user dismisses alert
    }
  </script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/parkmap.css">
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
                <li><a href="parkmap.php">Park-map</a></li>
                <li><a href="bookhistory.php">Your-slots</a></li>
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


<div class="main">

    <div class="leftside">
        <div class="head">
            <div class="carnos">
             <i class="fa fa-car" id="caricon"></i>
             <span>C1-10</span>
            </div>
             
            <div class="bikenos">
             <i class="fa fa-motorcycle" id="caricon"></i>
             <span>B1-10</span>
            </div>
          </div>
          <div class="container" id="cont1">
             <div class="flex1">
                 <div class="item">
                     <div class="square" id="B1">B1</div>
                     <div class="square" id="B2">B2</div>
                     <div class="square" id="B3">B3</div>
                     <div class="square" id="B4">B4</div>
                     <div class="square" id="B5">B5</div>
                 </div>
                 <div class="item">
                     <div class="square" id="C1">C1</div>
                     <div class="square" id="C2">C2</div>
                     <div class="square" id="C3">C3</div>
                     <div class="square" id="C4">C4</div>
                     <div class="square" id="C5">C5</div>
                 </div> 
             </div>
     
             <div class="flex2">
                 <div class="item">
                     <div class="square" id="C6">C6</div>
                     <div class="square" id="C7">C7</div>
                     <div class="square" id="C8">C8</div>
                     <div class="square" id="C9">C9</div>
                     <div class="square" id="C10">C10</div>
                 </div>
                 <div class="item">
                     <div class="square" id="B6">B6</div>
                     <div class="square" id="B7">B7</div>
                     <div class="square" id="B8">B8</div>
                     <div class="square" id="B9">B9</div>
                     <div class="square" id="B10">B10</div>
                 </div>
             </div>
         </div>
    </div> 
 

    <div class="rightside" id="rightside">
        <h4>Reserve Slot</h4>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="resform" name="resform">
            <div class="forminputs">
                <label class="selectslot">Selected Slot:</label>
                <input type="text" name="selectedslot" id="selected-slot" readonly required><br>
            </div>
            <div class="forminputs">
                <label>Start Time:</label>
                <input type="time" name="start-time"  id="start-time" min="08:00" max="17:00" required><br>
            </div>
    
            <div class="forminputs">
                <label>End Time:</label>
                <input type="time" name="end-time"  id="end-time" min="08:00" max="17:00" required><br>
            </div>

            <div class="logbutton">
                <button id="btn1" class="btn">Submit</button>
            </div>
        </form>
    </div>
</div>
    <script src="../js/slot.js"></script>
    <script src="../js/parkmap.js"></script>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $selectedslot=$_POST["selectedslot"];
    $starttime=$_POST["start-time"];
    $endtime=$_POST["end-time"];
    $username=$_SESSION["username"];
    if(($selectedslot!="")&&!empty($starttime)&&!empty($endtime)){
        date_default_timezone_set('Asia/Kolkata');
        $slotdate = date('Y-m-d');
        $sql1="SELECT * FROM reservationdetails";
        $res1=mysqli_query($conn,$sql1);

        if(mysqli_num_rows($res1)==0){
            $sql2="ALTER TABLE reservationdetails AUTO_INCREMENT = 1";
            $res2=mysqli_query($conn,$sql2);
        }

        $sql3="INSERT INTO reservationdetails(slotno,username,starttime,endtime,slotdate,status) VALUES('$selectedslot','$username','$starttime','$endtime','$slotdate','booked')";
        $res3=mysqli_query($conn,$sql3); 
    
        header("Location:parkmap.php");
    }

}
mysqli_close($conn);
?>