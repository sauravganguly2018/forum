<?php
// session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="../">iDiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="../">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql="SELECT * FROM `categories`";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          echo '<li><a class="dropdown-item" href="..//threadlist.php?catid='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
        }
       echo ' </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../contact.php">Contact</a>
      </li>
    </ul>
    <form class="d-flex" action="../search.php" method="get">';
         if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
          echo'<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <p class="text-light mb-0 mx-2">Welcome '.$_SESSION['useremail'].'</p>
        <a href="../partials/_handlelogout.php"><button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Logout</button></a>';
         }else{
          echo'<input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-outline-success " data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
         }

   echo ' </div>
         </div>
        </nav>';

include 'partials/_loginModal.php';
include 'partials/_signupModal.php';
if(isset($_GET['signupsuccess'])){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> You can now login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['showError'])){
  echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
  <strong>Error!</strong> '.$_GET['showError'].'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['showAlert'])){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong> '.$_GET['showAlert'].'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>