<?php
session_start();
require_once('connection.php');
$isEmpty = false;
$hasPasswordCertainLength = true;
$hasPasswordAtLeastOneNumber = true;
$passwordAreSame = true;
$usernameOrEmailAlreadyExists = false;
$emailOk = false;
 
 
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$surname = mysqli_real_escape_string($conn, $_POST['surname']);
$password = mysqli_real_escape_string($conn, $_POST['psw']);
 
if(empty($_POST["email"])){
    $isEmpty = true;
}
if(empty($_POST["username"])){
    $isEmpty = true;
}
if(empty($_POST["surname"])){
    $isEmpty = true;
}
if(empty($_POST["psw"])){
    $isEmpty = true;
}
if(empty($_POST["psw-repeat"])){
    $isEmpty = true;
}
if($isEmpty == true){
    echo "Nieco si nezadal" . "<br>";
}

$email = $_POST['email']; 
$regex = "/^[_a-z0-9-]+(.[_a-z0-9-]+)@[a-z0-9-]+(.[a-z0-9-]+)(.[a-z]{2,3})$/"; 
if (preg_match($regex, $email)) {
    $emailOk = true;
} else { 
    header('Location: ../register.php?message=Neplatny email!');
}

if (!preg_match("/[0-9]/", $password)) {
    $hasPasswordAtLeastOneNumber = false;
    header('Location: ../register.php?message=Heslo musi obsahovat aspon jeden ciselny znak!');
}
 
//hodenie veci do session
$_SESSION['em'] = $_POST['email'];
$_SESSION['user'] = $_POST['username'];
$_SESSION['sur'] = $_POST['surname'];
$_SESSION['pass'] = $_POST['psw'];
$_SESSION['pass-repeat'] = $_POST['psw-repeat'];
 
 
if($_POST["psw"] == $_POST["psw-repeat"]){
    $passwordAreSame = true;
}
else{
    $passwordAreSame = false;
    header('Location: ../register.php?message=Hesla sa nezhoduju');
}
 
if(strlen($password) < 6){
    $hasPasswordCertainLength = false;
    header('Location: ../register.php?message=Heslo musi obsahovat minimalne 6 znakov');
}
else{
    $hasPasswordCertainLength = true;
}
$s = rand(1,3);
switch($s) {
    case 1:
        $avatar = "user.png";
        break;
    case 2:
        $avatar = "200.gif";
        break;
    case 3:
        $avatar = "sus.png";
        break;        
}
$sql_u = "SELECT * FROM users WHERE username='$username'";
$sql_e = "SELECT * FROM users WHERE email='$email'";
$res_u = mysqli_query($conn, $sql_u);
$res_e = mysqli_query($conn, $sql_e);
 	
if(mysqli_num_rows($res_e) > 0){
    $usernameOrEmailAlreadyExists = true;
    header('Location: ../register.php?message=Email uz bol pouzity');
}
 
if($isEmpty == false && $hasPasswordCertainLength && $hasPasswordAtLeastOneNumber == true && $passwordAreSame == true && $usernameOrEmailAlreadyExists == false && $emailOk == true){
    $hash = md5($_POST["psw"]);
    $sql = "INSERT INTO users (username, surname, password, email, avatar) 
    VALUES('$username', '$surname', '$hash', '$email', '$avatar')";
    if ($conn->query($sql) == true){       
        header('Location: ../login.php?message=Registracia bola uspesna');
        session_destroy();
    }
    else{
        echo "Error" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>