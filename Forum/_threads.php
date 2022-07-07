<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Coding-Forum</title>
</head>

<body>
    <?php include'partials/_header.php';
    ?>
    <?php include'partials/_dbconnect.php';
    ?>
    <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `categories` WHERE category_id=$id";
    $result=mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
    $catname=$row['category_name'];
    $catdesc=$row['category_description'];

  
    }

    ?>
    <?php
    $method=$_SERVER['REQUEST_METHOD'];
    $showAlert=false;
    if($method=='POST'){
        $th_title=$_POST['title'];
        $th_title=str_replace("<","&lt;",$th_title);
        $th_title=str_replace(">","&gt;",$th_title);
        $th_desc=$_POST['desc'];
        $th_desc=str_replace("<","&lt;",$th_desc);
        $th_desc=str_replace(">","&gt;",$th_desc);
        $sno=$_POST['sno'];
        $sql="INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
        $result=$conn->query($sql);
        $showAlert=true;
    }
    if($showAlert){
        echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Succesful!</strong> Your query has been submiited succesfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }
    
    ?>
    <div class="container ">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> Thread</h1>
            <p class="lead"><?php echo $catdesc;?></p>
            <hr class="my-4">
            
            
        </div>

    </div>
<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

    echo'<div class="contaier mx-5">
        <h1 class="py-2">Ask Your Question</h1>
        <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
}else{
    echo'<div class="container ">
    <div class="jumbotron">
        <h1 class="display-8">You need to login to ask a Question</h1>
        
        <hr class="my-1">
        
        
    </div>';
}
    ?>
    <div class="container my-3">
        <h1 class="py-2">Browse questions</h1>
        <?php
    $id=$_GET['catid'];
    $sql="SELECT * FROM `threads` WHERE thread_cat_id='$id'";
    $result=mysqli_query($conn,$sql);
    $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
    $thread_title=$row['thread_title'];
    $thread_desc=$row['thread_desc'];
    $threadid=$row['thread_id'];
    $thread_time=$row['timestamp'];
    $thread_user_id=$row['thread_user_id'];
    $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
    $result2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_assoc($result2);
    

    echo'<div class="media my-3">
        <img src="img/user.png" width="45px" class="mr-3" alt="...">
        <div class="media-body">
        <p class="font-weight-bold">'.$row2['user_email'].' at '.$thread_time.'</p>
            <h5 class="mt-0"><a href="thread.php" class="text-dark"><a href="thread.php?threadid='.$threadid.'">'.$thread_title.'</a></h5>
            <p>'.$thread_desc.'</p>
        </div>
    </div>';
    }
    if($noResult){
        echo'<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Questions For This Category</h1>
          <p class="lead">Be the first person to ask the question.</p>
        </div>
      </div>';
    }
    ?>
    </div>
    <?php include'partials/_footer.php';
    ?>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
    -->
</body>

</html>