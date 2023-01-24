<?php
require_once('scripts/connection.php');
include('parts/header.php');

?>
<style>
    .container {
        width: 20%;
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        margin-top: 50px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    .container form {
        width: 100%;
        max-width: 500px;
        padding: 15px;
        margin: auto;
    }

    .container form .form-control {
        margin-bottom: 1rem;
    }

    .container form button {
        width: 100%;
    }

    .container form .btn-link {
        width: 100%;
        text-align: center;
    }

    .container form .btn-link a {
        color: #007bff;
    }

    .container form .btn-link a:hover {
        text-decoration: none;
    }

    .container form .btn-link a:active {
        color: #0056b3;
    }

    .container form .btn-link a:visited {
        color: #0056b3;
    }

    .container form .btn-link a:focus {
        color: #0056b3;
    }

    button[type="submit"] {
        background-color: #000;
        border-color: #000;
        color: #fff;
    }

    button[type="submit"]:hover {
        background-color: #fff;
        border-color: #000;
        color: #000;
        transition: 0.5s;
    }

</style>
<?php $message = isset($_GET["message"]) ? $_GET["message"] : "";?>
<main class>
  <form action="scripts/avatar_change_script.php" method="post">
    <div class="container">
      <h1 style="font-family: 'Courier New', Courier, monospace; font-weight: 700;">Zmena avatara</h1>
      <hr>
      <img src="images/<?php  echo $avatar;?>"  style="width: 200px; border-radius: 20px;">
      <p><select name="avatar"style="margin-top: 30px;" class="form-select form-select-lg form-select-border-width-2" aria-label=".form-select-lg example">
          <option disabled selected>Vyberte avatara</option>
          <option value="user.png">User</option>
          <option value="sus.png">Sus</option>
          <option value="200.gif">Banana</option>
        </select>
      <p><button type="submit" class="btn btn-outline-secondary">Zmenit</button>
      <p class="text-danger"><?php echo $message ?></p>
    </div>
  </form>
</main>