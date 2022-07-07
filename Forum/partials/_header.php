<?php
session_start();
echo'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a class="navbar-brand" href="#">Navbar</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <li class="nav-item active">
      <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="about.php">About</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
        Dropdown
      </a>
      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link " href="contact.php">Contact</a>
    </li>
  </ul>
  ';
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        echo'<div class="row mx-3">
        <form class="form-inline my-2 my-lg-0" method="get" action="search.php" >
          <input class="form-control mr-sm-2" type="search" name="search"  placeholder="Search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
          <p class="text-light mx-2 my-0">Welcome '.$_SESSION['username'].'</p></form>
          <a href="/forum/partials/_logout.php" class="btn btn-outline-success ml-2">Logout</a>
          </div>
          </div>
  </nav>';
    
  }else{
    echo'<div class="row mx-3">
    <form class="form-inline my-2 my-lg-0" method="get" action="search.php">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" name="search" aria-label="Search">
          <button class="btn btn-success my-2 my-sm-0" type="submit">Search</button>
            <button type="button" class="btn btn-outline-success ml-2" data-toggle="modal" data-target="#loginModal"  >Login</button>
            <button type="button" class="btn btn-outline-success mx-2" data-toggle="modal" data-target="#signupModal">Signup</button>
        </form></div>
</div>
  </nav>';
}

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo'<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Succesfull!</strong> You have succesfully signup.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
if(isset($_GET['exist']) && $_GET['exist']=="true"){
  echo'<div class="alert alert-warning alert-dismissible fade show my-0" role="alert">
  <strong>Error!</strong>'.$_GET["error"].'.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>