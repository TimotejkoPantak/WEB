<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./styles/register_style.css" </head>
  <style>
    /* .container {
      text-align: center;
  }
  h1 {
    padding-top: 50px;
  }  */
  </style>
  <title>Register</title>


<body>
  <?php
  include('parts/header.php');
  /*include('scripts/register_script.php');*/
  ?>
  <?php $email = isset($_SESSION['em']) ? $_SESSION['em'] : ""; ?>
  <?php $meno = isset($_SESSION['user']) ? $_SESSION['user'] : ""; ?>
  <?php $heslo = isset($_SESSION["pass"]) ? $_SESSION["pass"] : ""; ?>
  <?php $hesloOpak = isset($_SESSION["pass-repeat"]) ? $_SESSION["pass-repeat"] : ""; ?>
  <?php $priezvisko = isset($_SESSION["sur"]) ? $_SESSION["sur"] : ""; ?>
  <?php $message = isset($_GET["message"]) ? $_GET["message"] : ""; ?>
  <main>
    <div class="container">
      <form class="reg_form" action="scripts/register_script.php" method="post">


        <h1 style="margin-top: 30px;">Registracia</h1>
        <hr>
        <p><label for="username"><b>Meno</b></label>
          <br><input type="text" placeholder="Zadajte meno" name="username" id="username" value="<?php echo $meno; ?>" required>

        <p><label for="surname"><b>Priezvisko</b></label>
          <br><input type="text" placeholder="Zadajte Priezvisko" name="surname" id="surname" value="<?php echo $priezvisko; ?>" required>

        <p><label for="email"><b>Email</b></label>
          <br><input type="text" placeholder="Zadajte Email" name="email" id="email" value="<?php echo $email; ?>" required>

        <p><label for="psw"><b>Heslo</b></label>
          <br><input type="password" placeholder="Zadajte Heslo" name="psw" id="psw" value="<?php echo $heslo; ?>" required>

        <p><label for="psw-repeat"><b>Heslo znova</b></label>
          <br><input type="password" placeholder="Znovu Zadajte heslo" name="psw-repeat" id="psw-repeat" value="<?php echo $hesloOpak; ?>" required>
        <br>
        <p><button type="submit" class="btn btn-secondary">Registrovat sa</button>
        <p>
        <p style="font-weight: bolder;">Uz mate ucet?
        <p><a href="login.php" class="signin">Prihlaste sa</a></p>
        <p class="text-danger"><?php echo $message ?></p>
    </div>

    </form>
  </main>
</body>
<div class="footer">
<?php include('parts/footer.php'); ?>
</div>

</html>