<?php
session_start();
if (isset($_SESSION["login"])) {
  header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/css/bootstrap.min.css" />
  <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
  <div class="background">
    <div class="shape"></div>
    <div class="shape"></div>
  </div>
  <div class="container mt-4 ">
    <div class="row justify-content-center">
      <div class="col-3">
        <div class="alert alert-danger alert-dismissible fade <?= isset($_SESSION["loginError"]) ? 'show' : ''; ?>" role="alert">
          Login failed!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
      </div>
    </div>

    <form action="login-process.php" method="post">
      <h3>Login Sekarang</h3>

      <label for="username">Username</label>
      <input type="text" placeholder="Username" id="username" name="username" autofocus required>

      <label for="password">Password</label>
      <input type="password" placeholder="Password" id="password" name="password" required>

      <button class="button-login" type="submit" name="login">Login</button>
    </form>

    <script src="public/js/bootstrap.bundle.min.js"></script>
</body>

</html>