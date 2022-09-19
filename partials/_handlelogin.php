<?php
include '_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['loginEmail'];
    $pass=$_POST['loginPassword'];
    $sql="SELECT * FROM `users` WHERE user_email='$email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows==1){
       $row=mysqli_fetch_assoc($result);
       if(password_verify($pass,$row['user_password'])){
           session_start();
           $_SESSION['loggedin']=true;
           $_SESSION['useremail']=$email;
           header("location: ../index.php");
       }else{
        $showError="Password does not match";
        header("location: ../index.php?showError=$showError");
    }
    }else{
        $showError="This Username does not exists";
        header("location: ../index.php?showError=$showError");
    }
}
?>