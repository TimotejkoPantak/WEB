<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./styles/login_style.css">

</head>
<style>
  /* .container {
    text-align: center;
  }
  h1 {
    padding-top: 50px;
  } */
</style>

<body>
  <?php include('./parts/header.php') ?>
  <?php $message = isset($_GET["message"]) ? $_GET["message"] : ""; ?>
  <div class="container">
    <main>
      <div class="container">
        <form class="reg_form" action="./scripts/login_script.php" method="post">

          <h1>Prihlasenie</h1>
          <hr>
          <p><label for="email"><b>Email</b></label>
            <br><input type="text" placeholder="Zadajte Email" name="email" id="email" required>

          <p><label for="psw"><b>Heslo</b></label>
            <br><input type="password" placeholder="Zadajte Heslo" name="psw" id="psw" required>

          <p><button type="submit" class="btn btn-secondary">Prihlasit sa</button>
          <p class="text-danger"><?php echo $message ?></p>
          <hr>
          <p style="font-weight: bolder; margin-top: 10px;">Nemate ucet?
          <p><a href="register.php" class="signin">Zaregistrujte sa</a></p>
          
      </form>
      </div>
    </main>
  </div>
  <div class="footer">
  <?php include('./parts/footer.php') ?>
  </div>
</body>
</html>