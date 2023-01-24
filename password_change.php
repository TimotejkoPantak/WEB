<?php 
require_once('scripts/connection.php');
include('parts/header.php'); 
?>
 <style>
  /* .container {
    text-align: center;
  }
  h1 {
    padding-top: 50px;
  } */
 
</style> 

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/password_change_style.css">
</head>
<?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
<main>
<form action="scripts/password_change_script.php" method="post">
        <div class="container">
          <h1 class="heading">Zmena hesla</h1>
          <hr>
            
          <p class="p"><label for="psw"><b>Stare Heslo</b></label>
          <br><input type="password" placeholder="Zadajte Stare Heslo" name="psw" id="psw" required>

          <p class="p"><label for="new-psw"><b>Nove Heslo</b></label>
          <br><input type="password" placeholder="Zadajte Nove Heslo" name="new-psw" id="new-psw" required>

          <p><button type="submit" class="btn">Zmenit</button>
          <p class="text-danger"><?php echo $message ?></p>
          <hr>
        </div>     
      </form>
</main>
<?php include('parts/footer.php'); ?>