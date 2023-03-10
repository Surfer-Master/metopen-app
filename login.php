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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="public/css/style.css">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="bi bi-list-nested"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <a class="nav-link disabled" href="index.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="usersLog.php">Users Log</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="manageUsers.php">Manage Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="manageUsers.php">Manage Devices</a>
            </li> -->
          </ul>
        </div>
      </div>
    </nav>

    <div class="row justify-content-center my-5">
        <div class="col-md-4 col-10">
            <div class="alert alert-danger alert-dismissible fade <?= isset($_SESSION["loginError"]) ? 'show' : '';?>" role="alert">
              <?= isset($_SESSION["loginError"]) ? $_SESSION["loginError"] : '' ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal text-center">Please login</h1>
                <form action="login-process.php" method="POST">
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" autofocus required value="<?= isset($_SESSION["loginError"]) ? $_SESSION["loginError-username"] : '';?>">
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary" type="submit" name="login">Login</button>
                </form>
                <!-- <small class="d-block text-center mt-3">Forgot your password? <a href="#">Reset your password!</a></small> -->
            </main>
        </div>
    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/script.js"></script>
  </body>
</html>
