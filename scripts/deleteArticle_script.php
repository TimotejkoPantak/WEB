<?php
session_start();
require_once('../articles/connection.php');

$del_url = isset($_GET["url"]) ? $_GET["url"] : "";  

$sql = "DELETE FROM articles WHERE url_ar ='$del_url'";
if($conn->query($sql) === true){
    header('Location: ../index.php');       
} 
else{
    echo "ERROR: Could not able to execute $sql. " . $conn->error;
}
  
$conn->close();
?>