<?php
require_once('../scripts/connection.php');
$isEmpty = false;
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['psw']);
$hash = md5($_POST["psw"]);

if (empty($email)) {
    $isEmpty = true;
}
if (empty($password)) {
    $isEmpty = true;
}

if ($isEmpty == true) {
    header('Location: ../login.php?message=Nieco si nezadal '.$email.''.$password.'');
}

if ($isEmpty == false) {
    $query = "SELECT * FROM users WHERE email='$email' AND password='$hash'";
    
    $results = mysqli_query($conn, $query);

    if (mysqli_num_rows($results) == 1) {
        session_start();
        $queryk = "SELECT * FROM users WHERE email='$email'";
        $resultk = $conn->query($queryk);
 
            while ($row = $resultk->fetch_row()) {
                $username = $row[1];
                }
        $_SESSION["username"] = $username;   
        header('Location: ../index.php');
    } 
    else {
        header('Location: ../login.php?message=Zadal si zly email alebo heslo');
    }
}
