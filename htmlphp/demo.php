<?php
 include("dbconn.php");
 session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/demo.css">
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
                <li><a href="../html/index.php">Home</a></li>
                <li><a href="../html/demo.php">Park-map</a></li>
                <!-- <li><a href="#">Contact</a></li> -->
                <li><a href="../html/bookhistory.php">Your-slots</a></li>
            </ul>
        </nav>
        <div class="logsignup" id="logsignup">
           <?php if(isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]===true):?>
            <span><?php echo '😎'.htmlspecialchars($_SESSION["username"])?></span>
            <button><a href="../html/logout.php"> Logout</a></button>
           <?php else:?>
            <a href="../html/login.html" id="log">Login</a>
            <button><a href="../html/signup.php"> Register</a></button>
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
                <input type="text" name="selectedslot" id="selected-slot" required readonly><br>
            </div>
            
            <!-- <div class="forminputs">
                <label>Vehicle Type:</label>
                <select name="vehicle-type" id="vehicle-type" required>
                    <option value="" selected disabled>Select Vehicle Type</option>
                    <option value="car">Car</option>
                    <option value="bike">Bike</option>
                </select>
            </div> -->
            
            <div class="forminputs">
                <label>Start Time:</label>
                <input type="time" name="start-time" id="end-time"  required><br>
            </div>
    
            <div class="forminputs">
                <label>End Time:</label>
                <input type="time" name="end-time" id="end-time" required><br>
            </div>

            <div class="logbutton">
                <button class="btn">Submit</button>
            </div>
        </form>
    </div>
</div>
    <script src="../js/slot.js"></script>
    <script src="../js/demo.js"></script>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $selectedslot=$_POST["selectedslot"];
    $starttime=$_POST["start-time"];
    $endtime=$_POST["end-time"];
    $username=$_SESSION["username"];
    if(!empty($selectedslot)&&!empty($starttime)&&!empty($endtime)){
        date_default_timezone_set('Asia/Kolkata');
        $slotdate = date('Y-m-d');
        $sql="INSERT INTO reservationdetails(slotno,userid,starttime,endtime,slotdate,status) VALUES('$selectedslot','$username','$starttime','$endtime','$slotdate','booked')";
        $res=mysqli_query($conn,$sql);

    }

}
mysqli_close($conn);
?>