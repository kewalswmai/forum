<?php
$server="localhost";
$username="root";
$password="";
$database="idiscuss";

$conn=mysqli_connect($server,$username,$password,$database);
if(!$conn){
    die("Connection is connect succesfully");
}
?>