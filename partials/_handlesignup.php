<?php
include '_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $user_email=$_POST['signupEmail'];
    $user_pass=$_POST['signupPassword'];
    $user_cpass=$_POST['signupcPassword'];
    $sql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $showError="Username already in use";
        header("location: ../index.php?showError=$showError");    
    }else{
        if($user_pass==$user_cpass){
            $hash=password_hash($user_pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_password`, `created`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
            if($result){
                header("location: ../index.php?signupsuccess=true");
                exit();
            }
        }else{
            $showError="Password does not match";
            header("location: ../index.php?showError=$showError");
        }
    }
}
?>