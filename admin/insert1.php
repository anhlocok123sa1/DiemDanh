<?php
session_start();
include_once("config.php");

if (isset ($_POST['text'])) {
    $text = $_POST['text'];
    $test = explode("-", $text);
    $mon_hoc=$_POST['mon_hoc'];
    $sql = "INSERT INTO table_attendance(STUDENTID,NAME,ma_lop,TIMEIN,MaMH) VALUES('$test[0]','$test[1]','$test[2]',NOW(),'$mon_hoc')";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        $_SESSION['error'] = $conn->error;
    }
}
header("location: admin/diemdanh.php");


$conn->close();
?>