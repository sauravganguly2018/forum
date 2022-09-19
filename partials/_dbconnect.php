<?php
$servername="localhost";
$username="anything";
$password="";
$database="idiscuss";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
  die('Database not connected due to the error : '. mysqli_connect_error());
}
else{
    // echo 'Your database is connected successfully';
}
?>