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
   echo '<div class="container" style="min-height:600px">
   <h1 class="my-3">Search results for "'.$_GET['search'].'" </h1>';
    $search=$_GET['search'];
    $sql="SELECT * FROM `threads` WHERE MATCH(thread_title,thread_description) against('$search')";
      $result=mysqli_query($conn,$sql);
      $noResult=true;
      while($row=mysqli_fetch_assoc($result)){
          $noResult=false;
          echo'<div class="result">
          <h3><a href="./thread.php?thread_id='.$row['thread_id'].'">'.$row['thread_title'].'</a></h3>
          <p>'.$row['thread_description'].'.</p>
      </div>';
      }
      if($noResult){
          echo '<div class="col-md-6" style="width:100%">
          <div class="p-3 bg-dark border rounded-3 text-light">
            <div class="display-4 mb-3">No Results Found</div>
            <h6>Suggestions :</h6>
            <ul type="circle">
              <li>Make sure that all words are spelled correctly.</li>
              <li>Try different keywords.</li>
              <li>Try more general keywords.</li>
            </ul>
          </div>
        </div>';
      }
      echo '</div>';
?>
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