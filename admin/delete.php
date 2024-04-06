<?php
session_start();
include_once ("../config.php");
if($_SERVER['REQUEST_METHOD']=="POST") {
    $mamh = $_POST['mamh'];
    $sql = "delete from mon_hoc where ma_mon_hoc = '$mamh'";
    if($conn->query($sql)) {
        header('location: admin.php'); 
        exit();
    } else {
        echo 'error';
    }
} else {
    header('Location: admin.php');
    exit();
}
?>