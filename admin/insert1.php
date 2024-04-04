<?php
session_start();
include_once("config.php");

if (isset ($_POST['text'])) {
    $text = $_POST['text'];
    $test = explode("-", $text);
    $mon_hoc=$_POST['mon_hoc'];
    $sql = "INSERT INTO diem_danh(student_id,ten,ma_lop,TIMEIN,ma_mon_hoc) VALUES('$test[0]','$test[1]','$test[2]',NOW(),'$mon_hoc')";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        $_SESSION['error'] = $conn->error;
    }
}
header("location: admin/diemdanh.php");


$conn->close();
?>