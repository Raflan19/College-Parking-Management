<?php
include("dbconn.php");
session_start();
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username=$_POST["username"];
    $email=$_POST["email"];
    $pass=$_POST["pass"];
    $dob=$_POST["dob"];
    if(!empty($username)&&!empty($email)&&!empty($pass)&&!empty($dob)){
        $signupinputs = array('username' => false, 'email' => false);

        foreach ($signupinputs as $key => $value) {
            $ch = ($key == 'email') ? $email : $username;
            $sql = "SELECT * FROM useraccs WHERE $key = '$ch'";
            try{
            $res = mysqli_query($conn, $sql);
            }
            catch(mysqli_sql_exception){
                echo "connection error";
              }
            if (mysqli_num_rows($res) > 0) {
                $signupinputs[$key] = true;
            }
        }
        if($signupinputs['username']==false && $signupinputs['email']==false){
        $sql2="INSERT INTO useraccs(username,email,pass,dob) VALUES('$username','$email','$pass','$dob')";
        try{
        $res2=mysqli_query($conn,$sql2);
        }
        catch(mysqli_sql_exception){
            echo "connection error";
          }
        $_SESSION["username"]=$username;
        $_SESSION["pass"]=$pass;
        $_SESSION["loggedin"]=true;
        echo json_encode($signupinputs);
        }
        else{
            echo json_encode($signupinputs);
        }
    }

 }
 mysqli_close($conn);
?>