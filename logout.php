<?php
session_start();
unset($_SESSION["loged"]);
header("location: login.php");
?>