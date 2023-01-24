<html>
  <body>
    <form action="send_password.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email"><br><br>
      <input type="submit" value="Send Password">
    </form>
  </body>
</html>

<?php
$to = "recipient@example.com";
$subject = "Your password";
$password = "mypassword";
$message = "Your password is: " . $password;
$headers = "From: sender@example.com";

mail($to, $subject, $message, $headers);
?>