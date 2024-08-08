<?php
include("dbconn.php");
session_start();

if(isset($_POST['id']) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $id = $_POST['id'];
    $username = $_SESSION["username"];

    // Ensure the reservation belongs to the logged-in user
    $sql = "DELETE FROM reservationdetails WHERE resid = $id AND username = $username";
    $stmt = mysqli_query($conn,$sql)
    // $stmt->bind_param("is", $id, $username);

    if($stmt->execute()){
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
}
$conn->close();
?>
