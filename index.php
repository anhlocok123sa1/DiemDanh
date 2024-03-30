<?php
session_start();
$server = "localhost";
$username = "root";
$password = "";
$dbname = "qrcodedb";

$conn = new mysqli($server, $username, $password, $dbname);
?>
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
            <div class="col-md-6">
                <video id="preview" width="100%"></video>

            </div>

            <div class="col-md-6">
                <form action="insert1.php" method="post" class="form-horizontal">
                    <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
                </form>
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
                        $sql = "SELECT ID,STUDENTID,NAME,CLASS,TIMEIN FROM table_attendance WHERE DATE(TIMEIN)=CURDATE()";
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
    </div>

    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                alert('No cameras found');
            }

        }).catch(function (e) {
            console.error(e);
        });

        scanner.addListener('scan', function (c) {
            document.getElementById('text').value = c;
            document.forms[0].submit();
            alert('Đã quét');
        });
    </script>
</body>

</html>