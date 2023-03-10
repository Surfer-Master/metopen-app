<?php
  session_start();
  if (!isset($_SESSION["login"])) {
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" /> -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css" />
  </head>
  <body>
    <!-- <div class="my-4">
      <h1 class="text-center fw-bold">Bootstrap heading</h1>
    </div> -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="bi bi-list-nested"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
              <a class="nav-link active" href="index.php">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="usersLog.php">Users Log</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manageUsers.php">Manage Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manageDevices.php">Manage Devices</a>
            </li> -->
          </ul>
          <div class="text-end">
            <a href="login.php" class="text-decoration-none">
              <button type="button" class="btn btn-outline-light <?= isset($_SESSION["login"]) ? 'd-none' : '';?>">Login</button>
            </a>
            <form action="logout.php" method="POST" class="<?= isset($_SESSION["login"]) ? '' : 'd-none';?>">
              <button type="submit" class="btn btn-outline-danger bi bi-box-arrow-right" name="logout">Logout</button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <div class="py-4 px-3 px-lg-5">
      <h2 class="py-3 text-center fw-bold">Users Fingerprint Lists</h2>
      <div class="row justify-content-center pt-2">
        <div class="table-responsive col-8">
          <table class="table table-striped table-hover">
            <thead class="table-dark">
              <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Fingerprint ID</th>
                <th scope="col">Time created</th>
                <th scope="col">Device Name</th>
              </tr>
            </thead>
            <tbody>
            <?php
              require'conn.php';
              $i = 1;
              $sql = "SELECT * FROM users LEFT JOIN devices ON users.device_id = devices.device_id WHERE add_fingerid=0 ORDER BY users.id DESC";
              $result = mysqli_stmt_init($conn);
              if (!mysqli_stmt_prepare($result, $sql)) {
                echo '
                  <div class="alert alert-warning" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> SQL Error!
                  </div>
                ';
              }
              else {
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if (mysqli_num_rows($resultl) > 0){
                    while ($row = mysqli_fetch_assoc($resultl)){
            ?>
                      <tr class="text-center">
                        <th scope="row"><?= $i++ ?></th>
                        <td><?= $row['username']?></td>
                        <td><?= $row['fingerprint_id'] ?></td>
                        <td><?= $row['user_created_at'] ?></td>
                        <td><?= $row['device_name'] ?></td>
                      </tr>
            <?php
                    } 
                } else {
            ?>
                      <tr>
                        <td colspan="5">No Fingerprint Data</td>
                      </tr>
            <?php
                    }
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="public/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
