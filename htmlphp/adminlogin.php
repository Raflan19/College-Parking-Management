<?php
 include("dbconn.php");
 session_start();
 if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST["username"])&&!empty($_POST["pass"])){
            $adminname=$_POST["username"];
            $adminpass=$_POST["pass"];
            $sql="SELECT * FROM adminaccs WHERE adminname='$adminname' AND adminpass='$adminpass'";
            try{
            $res=mysqli_query($conn,$sql);
            }
            catch(mysqli_sql_exception){
                echo "connection error";
              }
            if(mysqli_num_rows($res)>0){
                $_SESSION["adminname"]=$adminname;
                $_SESSION["adminpass"]=$adminpass;
                $_SESSION["adminloggedin"]=true;
                echo json_encode(['success' => true]);
            }
            else{
                echo json_encode(['success' => false]);
            }
            
        } 
    }
    mysqli_close($conn);
?> 