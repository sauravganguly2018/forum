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
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $firstn=$_POST['firstn'];
        $lastn=$_POST['lastn'];
        $fathern=$_POST['fathern'];
        $contact=$_POST['contact'];
        $address=$_POST['address'];
        $address2=$_POST['address2'];
        $city=$_POST['city'];
        $state=$_POST['state'];
        $zip=$_POST['zip'];
        $sql="INSERT INTO `contacts` (`first_name`, `last_name`, `father_name`, `contact_no`, `address`, `address2`, `city`, `state`, `zip`, `created`) VALUES ('$firstn', '$lastn', '$fathern', '$contact', '$address', '$address2', '$city', '$state', '$zip', current_timestamp())";
        $result=mysqli_query($conn,$sql);
        if($result){
            $showAlert="Your details has been saved";
            echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
            <strong>Success!</strong> '.$showAlert.'.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }else{
          $showAlert="Your details has not been saved yet";
          echo '<div class="alert alert-warning alert-dismissible fade show mb-0" role="alert">
          <strong>Success!</strong> '.$showAlert.'.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
    }
    ?>  
    <div class="container my-3" style="min-height:600px">
   <h2 class="text-center  my-3">Contact Us</h2>
   <form class="row g-3" action="./contact.php" method="post" >
   <div class="col-md-6">
    <label for="inputEmail4" class="form-label">First Name</label>
    <input type="text" class="form-control" name="firstn" id="firstn" maxlength='25'>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Last Name</label>
    <input type="text" class="form-control" name="lastn" id="lastn" maxlength='25'>
  </div>

  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Father's Name</label>
    <input type="text" class="form-control" name="fathern" id="fathern" maxlength='50'>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Contact no</label>
    <input type="number" class="form-control" name="contact" id="contact" min="1000000000" max="9999999999">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" maxlength="150">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Address 2</label>
    <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment, studio, or floor" maxlength="150">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" maxlength="25" name="city" id="city">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">State</label>
    <select name="state" id="state" class="form-select">
      <option >Jharkhand</option>
      <option selected>Bihar</option>
      <option>Goa</option>
      <option>Uttar Pradesh</option>
      <option>Madhya Pradesh</option>
      <option>Karnatak</option>
      <option>Maharashtra</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="number" class="form-control" min="100000" max="999999" name="zip" id="zip">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>

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