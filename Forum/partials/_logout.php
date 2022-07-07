<?php
session_start();
echo'Logging out please wait....';
session_destroy();
header("location:/forum/index.php");
?>