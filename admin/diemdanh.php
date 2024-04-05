<?php
session_start();
include_once ("../config.php");
if ($_SESSION["loged"] != "admin") {
    header("location:../login.php");
}
// Kiểm tra nếu có thông báo lỗi trong session
if (isset($_SESSION['error'])) {
    $error_message = $_SESSION['error'];
    // Xóa thông báo lỗi trong session để tránh hiển thị lại nếu refresh trang
    unset($_SESSION['error']);
}
?>
<html>

<head>
    <script type="text/javascript" src="../js/adapter.min.js"></script>
    <script type="text/javascript" src="../js/vue.min.js"></script>
    <script type="text/javascript" src="../js/instascan.min.js"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <?php
        include_once ("../header.php");
        ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>

            </div>

            <div class="col-md-6">
                <form action="insert1.php" method="post" class="form-horizontal">
                    <label>SCAN QR CODE</label>
                    <input type="text" name="text" id="text" readonly placeholder="scan qrcode" class="form-control">
                    <select class="form-control" name="mon_hoc" id="mon_hoc">
                        <?php
                        $sql = "select ma_mon_hoc, ten_mon_hoc from mon_hoc";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['ma_mon_hoc'] ?>">
                                <?php echo $row['ten_mon_hoc'] ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>STUDENT ID</td>
                            <td>NAME</td>
                            <td>CLASS</td>
                            <td>TIMEIN</td>
                            <td>Môn học</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT ID,student_id,ten,ma_lop,TIMEIN,ma_mon_hoc FROM diem_danh WHERE DATE(TIMEIN)=CURDATE()";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['student_id']; ?>
                                </td>
                                <td class="name">
                                    <?php echo $row['ten']; ?>
                                </td>
                                <td>
                                    <?php echo $row['ma_lop']; ?>
                                </td>
                                <td class="time_in">
                                    <?php echo $row['TIMEIN']; ?>
                                </td>
                                <td class="ten_mon_hoc">
                                    <?php
                                    $sql1 = "SELECT ten_mon_hoc FROM MON_HOC WHERE ma_mon_hoc='" . $row['ma_mon_hoc'] . "'";
                                    $query1 = $conn->query($sql1);
                                    while ($row1 = $query1->fetch_assoc()) {
                                        echo $row1['ten_mon_hoc'];
                                    }
                                    ?>
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

            const scannerValue = c.split('-');

            document.forms[0].submit();
            alert('Đã quét');
        });
    </script>
</body>

</html>