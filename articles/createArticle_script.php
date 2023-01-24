<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/create_article_style.css">
</head>


<?php
session_start();
require_once('connection.php');
require_once('../scripts/connection.php');
$isEmpty = false;

$title = mysqli_real_escape_string($conn, $_POST['Title']);
$text = mysqli_real_escape_string($conn, $_POST['Text']);
$author = mysqli_real_escape_string($conn, $_POST['Author']);
$img = mysqli_real_escape_string($conn, $_POST['Img']);
$category = mysqli_real_escape_string($conn, $_POST['Category']);

if(empty($title)){
    $isEmpty = true;
}
if(empty($text)){
    $isEmpty = true;
}
if(empty($author)){
    $isEmpty = true;
}

if($isEmpty == true){
    header('Location: createArticle.php?message=Niečo nebolo zadané');
}

if($isEmpty == false){
    $user = $_SESSION["username"];
    $query = "SELECT avatar,id FROM users WHERE username='$user'";
    $result = $conn->query($query);

    while ($row = $result->fetch_assoc()) {
        $avatar=$row["avatar"];
        $id=$row["id"];
    }

    $id_author = $id;

    function createUrlSlug($urlString){
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $urlString);
        return $slug;
    }
    
    $url_ar = createUrlSlug($title);
    $url_ar = $url_ar.'-'.time();

    $sql = "INSERT INTO db.articles (Title, Text, Cover_image, Autor, url_ar, id_author, category)
    VALUES('$title', '$text', '$img', '$author', '$url_ar', '$id_author', '$category')";
    if ($conn->query($sql) == true){       
        header('Location: createArticle.php?message=Článok bol úspešne vytvorený');
    }
    else{
        echo "Error" . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}