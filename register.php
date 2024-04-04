<?php
session_start();
include_once ("config.php");
$showAlert = false;
$showError = false;
$exists = false;

$usernameErr = $passErr = "";
const REQUIRED_MSG = "is required";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Include file which makes the 
    // Database Connection. 
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $mssv = $_POST["mssv"];
    $name = ucwords($_POST["name"]);
    $class = strtoupper($_POST['class']);

    $patternname = "/[A-Z][A-Z]\d{8}/";
    $matchesname = null;
    $returnvalname = preg_match($patternname, $mssv, $matchesname);

    $patternclass = "/[D]\d{2}_([T][H]|[X][D]|[T][P])\d{2}/";
    $matchesclass = null;
    $returnvalclass = preg_match($patternclass, $class, $matchesclass);

    $sql = "Select * from user where username='$username'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    // This sql query is use to check if 
    // the username is already present 
    // or not in our Database 
    if ($num == 0) {
        if (empty($_POST["username"])) {
            $nameErr = "Username " . REQUIRED_MSG;
            $showError = $nameErr;
        } else if (empty($_POST["password"])) {
            $passErr = "Password " . REQUIRED_MSG;
            $showError = $passErr;
        } else if ($returnvalname != 1) {
            $showError = 'Mã số sinh viên phải theo mẫu VD: DH52001727';
        } else if ($returnvalclass != 1) {
            $showError = 'Mã lớp phải theo mẫu VD: D20_TH02';
        } else if (($password == $cpassword) && $exists == false) {

            $hash = md5($password);

            // Password Hashing is used here. 
            $sql = "INSERT INTO `user` ( `username`, 
				`password`, `date`,`STUDENTID`,`NAME`,`ma_lop`) VALUES ('$username', 
				'$hash', current_timestamp(),'$mssv','$name','$class')";

            $result = mysqli_query($conn, $sql);
            header("location: admin/diemdanh.php");
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    }// end if 

    if ($num > 0) {
        $exists = "Username not available";
    }

}//end if 

?>

<!doctype html>

<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, 
        shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body>

    <?php
    include_once ("showarlert.php");

    ?>

    <div class="container my-4 ">

        <h1 class="text-center">Signup Here</h1>
        <form action="register.php" method="post">

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <span class="error">*
                    <?php echo $usernameErr; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <span class="error">*
                    <?php echo $passErr; ?>
                </span>
            </div>

            <div class="form-group">
                <label for="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">
                    Make sure to type the same password
                </small>
            </div>

            <div class="form-group">
                <label for="mssv">Mã số sinh viên</label>
                <input type="text" class="form-control" id="mssv" name="mssv" placeholder="DH52001727">
            </div>

            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Lê Lâm Tấn Lộc">
            </div>

            <div class="form-group">
                <label for="class">Lớp</label>
                <input type="text" class="form-control" id="class" name="class" placeholder="D20_TH02">
            </div>

            <button type="submit" class="btn btn-primary">
                SignUp
            </button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src=" 
https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity=" 
sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>

    <script src=" 
https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>

    <script src=" 
https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
        </script>
</body>

</html>