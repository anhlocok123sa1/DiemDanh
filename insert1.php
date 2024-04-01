<?php
session_start();
include_once("config.php");

if (isset ($_POST['text'])) {
    $text = $_POST['text'];
    $test = explode("-", $text);
    $mon_hoc=$_POST['mon_hoc'];
    $sql1 = "INSERT INTO table_student(STUDENTID,Name,Class,MaMH) VALUES('$test[0]','$test[1]','$test[2]','$mon_hoc')";
    if ($conn->query($sql1) != TRUE) {
        $_SESSION['error'] = $conn->error;
    }
    $sql = "INSERT INTO table_attendance(STUDENTID,NAME,CLASS,TIMEIN,MaMH) VALUES('$test[0]','$test[1]','$test[2]',NOW(),'$mon_hoc')";
    if ($conn->query($sql) === TRUE) {
    } else {
        $_SESSION['error'] = $conn->error;
    }
}
header("location: index.php");


$conn->close();
?>