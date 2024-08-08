<?php
session_start();
session_destroy();
$_SESSION["adminloggedin"]=false;
header("Location:adminlogin.html");
?>