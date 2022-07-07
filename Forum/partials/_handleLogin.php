

<?php
$showError="false";
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '_dbconnect.php';
    $login_user=$_POST['loginEmail'];
    $login_pass=$_POST['loginPass'];
    

    $Sql="SELECT * FROM `users` WHERE user_email='$login_user'";
    $result=mysqli_query($conn,$Sql);
    $num=mysqli_num_rows($result);
    if($num==1){
        $row=mysqli_fetch_assoc($result);
        if(password_verify($login_pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['sno']=$row["sno"];
            $_SESSION['username']=$login_user;
            echo'loggedin'.$login_user;
        }
        header("location:/forum/index.php");
    }
    header("location:/forum/index.php");
}
?>