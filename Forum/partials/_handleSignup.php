<?php
$showError = "false";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupCpassword'];

    $existSql = "SELECT * FROM `users` WHERE user_email='$user_email'";
    $result = mysqli_query($conn, $existSql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $showError = 'Username is already exist';
        
    } else {
        if ($pass == $cpass) {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               
                header("location:/forum/index.php?signupsuccess=true");
                exit();
            }
        } else {
            $showError = 'Passwords are not matched.';
           }
      }
    header("location:/forum/index.php?signupsuccess=false&exist=true&error=$showError");
}
