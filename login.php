<?php 
  session_start();
  if (isset($_SESSION["login"])) {
    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/login/login.css">
    <!--Stylesheet-->
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form>
        <h3>Login Sekarang</h3>

        <label for="username">Username</label>
        <input type="text" placeholder="Email" id="username">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password">

        <button>Login</button>
    </form>
</body>
</html>