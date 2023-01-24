<!DOCTYPE html>
<html lnag="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<head>
<?php 
session_start();
?>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">FTTU</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" style="display:flex;">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                            <a class="nav-link active" aria-current="page" href="createArticle.php">Create Article</a>
                            <?php include('../scripts/connection.php');?>
                            <?php
                                if(isset($_SESSION["username"])){
                                    $user = $_SESSION["username"];
                                    $query = "SELECT avatar,id,administrator FROM users WHERE username='$user'";
                                    $result = $conn->query($query);
                                    
                                    while ($row = $result->fetch_assoc()) {
                                        $avatar=$row["avatar"];
                                        $id=$row["id"];
                                        $admin = $row["administrator"];
                                    }

                                    if ($admin == 1){
                                        echo '<a class="nav-link active" aria-current="page" href="../users.php">Admin Panel</a>';
                                    }
                                }
                            ?>
                        </li>
                    </ul>
                    <?php if (!isset($_SESSION["username"])) : ?>
                        <div>
                            <a href="../register.php" class="btn btn-danger">Registracia</a>
                            <a href="../login.php" class="btn btn-success">Prihlasenie</a>
                        </div>
                    <?php else : ?>
                        <div class="d-flex align-items-center">
                            <p class="text-light mx-3 mb-0"> 
                            <?php include('../scripts/connection.php');?>
                                <?php include('../scripts/session.php');?>
                                <a href="../profile.php<?php  echo "?user=".$id;?>"class="text-decoration-none text-light"><?php echo $user; ?>
                                <a href="../profile.php<?php  echo "?user=".$id;?>"class="text-decoration-none"> <img src="../images/<?php  echo $avatar;?>"   style="width: 40px">
                            </p>
                            <a href="../scripts/logout.php" class="btn btn-danger">Odhlasenie</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>