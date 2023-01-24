<?php
session_start();
require_once('../scripts/connection.php');
include('scripts/session.php');
$username = $_SESSION["username"];

$query = "SELECT avatar,id FROM users WHERE username='$username'";
$result = $conn->query($query);

while ($row = $result->fetch_assoc()) {
    $avatar=$row["avatar"];
    $id=$row["id"];
}

$del_id = isset($_GET["id"]) ? $_GET["id"] : "";  

$sql = "DELETE FROM users WHERE id ='$del_id'";
if($conn->query($sql) === true){
    
    if($id == $del_id){
        session_destroy();
        header('Location: ../index.php');  
    }else{
        header('Location: ../index.php');
    }   
} 
else{
    echo "ERROR: Could not able to execute $sql. " . $conn->error;
}
  
$conn->close();
?>