<?php
include 'partials/_dbconnect.php';
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Forum</title>
</head>

<body>
    <?php include 'partials/_header.php' ?>

    <?php
    $showAlert=false;
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $content=$_POST['content'];
        $id=$_GET['thread_id'];
        $user=$_SESSION['useremail'];
        $sql2="SELECT * FROM `users` WHERE user_email='$user'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $sno=$row2['sno'];
        $sql="INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `created`) VALUES ('$content', '$id', '$sno', current_timestamp());";
        $result=mysqli_query($conn,$sql); 
        if($result){
            $showAlert=true;
        }else{
            
        }
    }
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>

    <div class="container">
        <div class="row align-items-md-stretch my-3">
            <div class="col-md-6 " style="width:100%">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <?php
                    $id=$_GET['thread_id'];
                $sql="SELECT * FROM `threads` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        $thread_id=$_GET['thread_id'];
        $sql2="SELECT * FROM `threads` WHERE thread_id=$thread_id";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $user=$row2['thread_user_id'];
        $sql3="SELECT * FROM `users` WHERE sno=$user";
        $result3=mysqli_query($conn,$sql3);
        $row3=mysqli_fetch_assoc($result3);
        $user_email=$row3['user_email'];
        while($row=mysqli_fetch_assoc($result)){
                $thread_title=$row['thread_title'];
                $thread_desc=$row['thread_description'];
                  echo '<h1>'.$thread_title.'</h1>
                    <p>'.$thread_desc.'</p>
                        <hr>
                        <p>This is peer to peer forum . No Spam / Advertising / Self-promote in the forums.Do not post copyright-infringing material.Do not post “offensive” posts, links or images.Do not cross post questions.Do not PM users asking for help.Remain respectful of other members at all times.</p>
                    <p>Posted by : '.$user_email.'</p>';

        }
        ?>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
   echo '  <div class="container mb-3">
   <h2>Post a Comment</h2>';
    // <form action="/forum/threadlist.php?thread_id='. $_GET["thread_id"].'" method="post"> 
   echo '<form action="'. $_SERVER["REQUEST_URI"].'" method="post">
           <div class="mb-3">
               <label for="exampleFormControlTextarea1" class="form-label mt-3">Type your comment</label>
               <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3"></textarea>
           </div>
           <button type="submit" class="btn btn-primary">Post Comment</button>
   </form>
</div>';
    }else{
        echo ' <div class="container">
        <h2>Post a Comment</h2>
        <p class="lead">You are not logged in . Please login to post a comment .</p>
    </div>';
    }

  ?>
    <div class="container" style="min-height:400px">

        <h2>Discussions</h2>

        <?php
                    $id=$_GET['thread_id'];
                $sql="SELECT * FROM `comments` WHERE thread_id=$id";
        $result=mysqli_query($conn,$sql);
        $noResult=true;
        while($row=mysqli_fetch_assoc($result)){
                $noResult=false;
                $content=$row['comment_content'];
                $content=str_replace('<','&lt',$content);
                $content=str_replace('>','&gt',$content);
                $comment_id=$row['comment_id'];
                $created=$row['created'];
                $comment_by=$row['comment_by'];
                $sql3="SELECT * FROM `users` WHERE sno=$comment_by";
                $result3=mysqli_query($conn,$sql3);
                $row3=mysqli_fetch_assoc($result3);
              echo '<div class="d-flex my-3">
              <div class="flex-shrink-0">
                  <img src="img/user.png" alt="..." style="width:40px">
              </div>
              <div class="flex-grow-1 ms-3">
              <p class="mb-0"><b>Commented by '.$row3['user_email'].' at '.$created.'</b></p>
                <p>'.$content.'</p>
              </div>
          </div>';
        
            }

            if($noResult){
                echo '<div class="col-md-6" style="width:100%">
                <div class="p-3 bg-dark border rounded-3 text-light">
                  <div class="display-4 mb-3">No comments Found</div>
                  <h6>Be the first Person to post a comment</h6>
                </div>
              </div>';
            }

            ?>

    </div>
    <?php include 'partials/_footer.php' ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>