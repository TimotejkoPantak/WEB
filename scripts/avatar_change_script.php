<?php
require_once('connection.php');
session_start();
$selected = $_POST['avatar'];
$uname = $_SESSION["username"];

if (!empty($selected)) {
    $sql = "UPDATE users SET avatar='$selected' WHERE username='$uname'";
    if ($conn->query($sql) == true) {
        header('Location: ../avatar_change.php?message=Zmena avatara bola uspesna!');
    } else {
        echo "Error" . $sql . "<br>" . $conn->error;
    }
}
