<?php
session_start();
include_once ("config.php");
?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="js/adapter.min.js"></script>
    <script type="text/javascript" src="js/vue.min.js"></script>
    <script type="text/javascript" src="js/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <?php
        include_once ("header.php");
        ?>

        <div class="row">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">User Information</h3>
                </div>
                <?php
                $user = $_SESSION["loged"];
                $sql = "SELECT STUDENTID,NAME,ma_lop FROM user WHERE username='$user'";
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
                                    <input class="form-control" type="text" value="<?php echo $row['NAME']; ?>" name="name"
                                        id="name" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Lớp</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="<?php echo $row['ma_lop']; ?>"
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

                if (isset($_POST["btnsubmit"])) {
                    require ('encode.php');
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
        </div>
    </div>
</body>

</html>