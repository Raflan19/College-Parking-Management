<?php
 include("dbconn.php");
 session_start();
 $sql="SELECT * FROM reservationdetails";
 try{
 $res=mysqli_query($conn,$sql);
 }
 catch(mysqli_sql_exception){
    echo "connection error";
  }
 $slots=mysqli_fetch_all($res,MYSQLI_ASSOC);
echo json_encode($slots);
mysqli_close($conn);
?>