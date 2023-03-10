<?php 
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit();
}
elseif (isset($_POST['login'])) {

    require 'conn.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    if (empty($username) || empty($password) ) {
		header("Location: login.php");
  		exit();
	}
    else {
        $sql = "SELECT * FROM admin WHERE username=?";
        $result = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($result, $sql)) {
			header("Location: login.php");
  			exit();
		}
        else {
            mysqli_stmt_bind_param($result, "s", $username);
			mysqli_stmt_execute($result);
			$resultl = mysqli_stmt_get_result($result);

            if ($row = mysqli_fetch_assoc($resultl)) {
				$pwdCheck = password_verify($password, $row['password']);
				if ($pwdCheck == false) {
                    $_SESSION["loginError"] = "Login failed!";
                    $_SESSION["loginError-username"] = "$username";
					header("Location: login.php");
  					exit();
				}
				else if ($pwdCheck == true) {
	                $_SESSION["login"] = true;
	                $_SESSION["login"] = true;

					$_SESSION['admin-name'] = $row['name'];
					$_SESSION['admin-username'] = $row['username'];

					header("location: index.php");
					exit();
				}
			}
			else{
				$_SESSION["loginError"] = "Login failed!";
                $_SESSION["loginError-username"] = "$username";
                header("Location: login.php");
  				exit();
			}
        }
    }
    mysqli_stmt_close($result);    
    mysqli_close($conn);
}
else {
    header("Location: login.php");
    exit();
}





?>
