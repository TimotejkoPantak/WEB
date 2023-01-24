<?php
require_once('scripts/connection.php');
include('parts/header.php');
include('scripts/profile_script.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/profile_style.css">
</head>

<main class="container">
    <h1 class="heading">Profil</h1>

    <?php foreach ($users as $user) : ?>

        <div class="container">
            <div class="row">
                <div class="col-4"><img src="images/<?php echo $user["avatar"] ?>" alt="<?php echo $user["username"] ?>" style="width: 300px;">
                    <?php if (isset($_SESSION["username"])) :
                        if ($_SESSION["username"] == $user["username"]) :?>
                            <a href="avatar_change.php" class="btn btn-danger" style="margin-left: 70px; margin-top: 20px;">Zmenit avatara</a>
                    <?php endif;
                    endif; ?>
                </div>
                <div class="col-6">
                    <p>

                    <div class="row">
                        <div class="col-4 list-group-item active">ID</div>
                        <div class="col-4 border-top list-group-item"><?php echo $user["id"] ?></div>

                        <div class="w-100"></div>

                        <div class="col-4 list-group-item active">Meno</div>
                        <div class="col-4 list-group-item"><?php echo $user["username"] ?></div>

                        <div class="w-100"></div>

                        <div class="col-4 list-group-item active">Priezvisko</div>
                        <div class="col-4 list-group-item"><?php echo $user["surname"] ?></div>

                        <div class="w-100"></div>

                        <div class="col-4 list-group-item active">Email</div>
                        <div class="col-4 list-group-item"><?php echo $user["email"] ?></div>
                        <div style="text-align: center; margin-top: 50px;">
                            <?php if (isset($_SESSION["username"])) :
                                if ($_SESSION["username"] == $user["username"]) :?>
                                    <a style="border-radius: 10px; padding: 10px; font-size: 20px;" href="password_change.php" class="btn btn-danger">Zmenit heslo</a>
                            <?php endif;
                            endif; ?>
                        </div>

                    <form method="post" action="" class="options"> 
                        <span class="hdng"><strong style="font-size: 20px; font-family: 'Courier New', Courier, monospace">Select API</strong></span><br/>
                        <input class="option" type="checkbox" name='api[]' value="vtip"> <span style="margin-right: 15px; font-size: 19px;" >Joke</span> </br>
                        <input class="option" type="checkbox" name='api[]' value="coin"> <span style="margin-right: 15px; font-size: 19px;">Crypto</span>  </br>
                        <input class="option"  type="checkbox" name='api[]' value="obrazok"> <span style="margin-right: 15px; font-size: 19px;">Astronomy</span> </br>

                        <input type="submit" value="Submit" name="submit" class="btn_sbmt">
                    </form>

                    <?php
                    $username_API = $_SESSION["username"];
                    if(isset($_POST['submit'])){

                        if(!empty($_POST['api'])) {
                            $new_api = ""; 
                            foreach($_POST['api'] as $value){
                                $new_api = $new_api." ".$value;
                            }

                            $sql = "UPDATE registration.users SET displayed_api='$new_api' WHERE username='$username_API'";
                            if ($conn->query($sql) == true){
                                echo "<p><strong>Uspesne zvolene:</strong></p>";     
                                foreach($_POST['api'] as $value){
                                    if ($value == "coin") echo "<p><strong>Crypto</strong></p>"; 
                                    if ($value == "vtip") echo "<p><strong>Joke</strong></p>";
                                    if ($value == "obrazok") echo "<p><strong>Astronomy</strong></p>";
                                }
                            }
                            else{
                                echo "Error" . $sql . "<br>" . $conn->error;
                            } 
                        } else{
                            $new_api = ""; 
                            $sql = "UPDATE registration.users SET displayed_api='$new_api' WHERE username='$username_API'";
                            if ($conn->query($sql) == true){
                                echo "Zrusene zobrazovanie API";     
                            }
                            else{
                                echo "Error" . $sql . "<br>" . $conn->error;
                            } 
                        }

                    }
?>
                    </div>

                </div>

            </div>

        </div>
    <?php endforeach ?>

</main>
<div class="footer">
    <?php include('parts/footer.php'); ?>
</div>