<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrcodedb";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Connection failed" . $conn->connect_error);
}

if (isset ($_POST['text'])) {
    $text = $_POST['text'];
    $test = explode("-", $text);
    $sql1 = "INSERT INTO table_student(STUDENTID,Name,Class) VALUES('$test[0]','$test[1]','$test[2]')";
    if ($conn->query($sql1) != TRUE) {
        $_SESSION['error'] = $conn->error;
    }
    $sql = "INSERT INTO table_attendance(STUDENTID,NAME,CLASS,TIMEIN) VALUES('$test[0]','$test[1]','$test[2]',NOW())";
    if ($conn->query($sql) === TRUE) {
    } else {
        $_SESSION['error'] = $conn->error;
    }
}
header("location: index.php");


$conn->close();
?>