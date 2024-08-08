<?php
 include("dbconn.php");
 session_start();
 if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(!empty($_POST["username"])&&!empty($_POST["pass"])){
            $username=$_POST["username"];
            $pass=$_POST["pass"];
            $sql="SELECT * FROM useraccs WHERE username='$username' AND pass='$pass'";
            try{
            $res=mysqli_query($conn,$sql);
            }
            catch(mysqli_sql_exception){
                echo "connection error";
              }
            if(mysqli_num_rows($res)>0){
                $_SESSION["username"]=$username;
                $_SESSION["pass"]=$pass;
                $_SESSION["loggedin"]=true;
                echo json_encode(['success' => true]);
            }
            else{
                echo json_encode(['success' => false]);
            }
            
        } 
    }
    mysqli_close($conn);
?> 