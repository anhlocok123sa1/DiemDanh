<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrcodedb";

$conn = new mysqli($server, $username, $password, $dbname);
?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="index.php">Home</a></li>
                    <?php
                    if (isset ($_SESSION["loged"])) {
                        ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 </a>
                        </li>
                        <li><a href="user.php">User</a></li>
                        <?php
                    }
                    ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset ($_SESSION["loged"])) {
                        echo '<li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>';
                    } else {
                        echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
                        echo '<li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>

        <div class="row">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">User Information</h3>
                </div>
                <?php
                $server = "localhost";
                $username = "root";
                $password = "";
                $dbname = "qrcodedb";

                $conn = new mysqli($server, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die ("Connection failed" . $conn->connect_error);
                }
                $user = $_SESSION["loged"];
                $sql = "SELECT STUDENTID,NAME,CLASS FROM user WHERE username='$user'";
                $query = $conn->query($sql);
                while ($row = $query->fetch_assoc()) {
                    $MSSV = $row["STUDENTID"];
                    ?>
                    <div class="card-body">
                        <form autocomplete="off" class="form" role="form" action="user.php" method="post">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">MSSV</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['STUDENTID']; ?>"
                                        name="studentid" id="studentid" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Họ tên</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['NAME']; ?>" name="name" id="name" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Lớp</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['CLASS']; ?>"
                                        name="class" id="class" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input class="btn btn-primary" type="submit" name="btnsubmit" value="Generate QR Code">
                                </div>
                            </div>
                        </form>
                        <?php
                }
                include "phpqrcode/qrlib.php";
                $PNG_TEMP_DIR = 'temp/';
                if (!file_exists($PNG_TEMP_DIR))
                    mkdir($PNG_TEMP_DIR);

                $filename = $PNG_TEMP_DIR . 'test.png';

                if (isset ($_POST["btnsubmit"])) {
                    require_once('encode.php');
                    $_POST["name"] = cleanNonAsciiCharactersInString($_POST["name"]);
                    $codeString = $_POST["studentid"] . "-";
                    $codeString .= $_POST["name"] . "-";
                    $codeString .= $_POST["class"];

                    $filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';

                    QRcode::png($codeString, $filename);

                    echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" /><hr/>';
                }

                ?>
                </div>
            </div><!-- /form user info -->
            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>STUDENT ID</td>
                            <td>NAME</td>
                            <td>CLASS</td>
                            <td>TIMEIN</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $server = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "qrcodedb";

                        $conn = new mysqli($server, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die ("Connection failed" . $conn->connect_error);
                        }
                        $sql = "SELECT ID,STUDENTID,NAME,CLASS,TIMEIN FROM table_attendance WHERE STUDENTID='$MSSV'";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['STUDENTID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['NAME']; ?>
                                </td>
                                <td>
                                    <?php echo $row['CLASS']; ?>
                                </td>
                                <td>
                                    <?php echo $row['TIMEIN']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
</body>

</html>