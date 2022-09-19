<?php
session_start();
session_destroy();
$showAlert="You have been successfully logged out";
header("location: ../index.php?showAlert=$showAlert");
?>