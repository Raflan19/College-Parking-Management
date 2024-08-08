<?php
$dbserver="localhost:3310";
$dbuser="root";
$dbpass="";
$dbname="parkingsys";
$conn="";
try{
$conn=mysqli_connect($dbserver,$dbuser,$dbpass,$dbname);
}
catch(mysqli_sql_exception){
    echo "invalid";
}
?>