<?php
session_start();
include_once ("config.php");
$showAlert = false;
$showError = false;
$exists = false;
if ($_SESSION["loged"] != 'admin') {
    header('location:diemdanh.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['AddSubject'])) {
        $mamh = $_POST['mamh'];
        $tenmh = $_POST['tenmh'];
        if (empty($mamh)) {
            $err = 'Mã môn học is Required';
            $showError = $err;
        } else if (empty($tenmh)) {
            $err = 'Tên môn học is Required';
            $showError = $err;
        } else {
            $sql = "insert into mon_hoc (`MaMH`,`Name`) values('$mamh','$tenmh')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        }
    }
    // if (isset($_POST["filter"])) {
    //     $mamh = $_POST['mamh'];
    //     $lop = $_POST['ma_lop'];
    //     if ($mamh == 'All' && $lop == 'All') {
    //         $sql = "select STUDENTID,NAME,ma_lop from user";
    //         $result = mysqli_query($conn, $sql);
    //     }
    // }
}
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
    <?php
    include_once ("showarlert.php");
    ?>
    <div class="container">
        <?php
        include_once ("header.php");
        ?>

        <div class="row">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Admin</h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>MaMH</td>
                            <td>Tên Môn Học</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select MaMH, Name from mon_hoc";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['MaMH'] ?>
                                </td>
                                <td>
                                    <?php echo $row['Name'] ?>
                                </td>
                                <td>
                                    <form method="post" action="delete.php">
                                        <input type="hidden" name="mamh" value="<?php echo $row['MaMH'] ?>">
                                        <?php
                                        $sql1 = "select * from table_attendance where MaMH ='" . $row['MaMH'] . "'";
                                        $query1 = $conn->query($sql1);
                                        if (mysqli_num_rows($query1) == 0) {
                                            ?>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            <?php
                                        }
                                        ?>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <form method="post" action="admin.php">
                    <div class="form-group">
                        <label for="mamh">Mã môn học</label>
                        <input type="text" class="form-control" id="mamh" name="mamh" placeholder="CS03042">
                    </div>

                    <div class="form-group">
                        <label for="tenmh">Tên môn học</label>
                        <input type="text" class="form-control" id="tenmh" name="tenmh"
                            placeholder="Triển khai hệ thống thông tin">
                    </div>

                    <input type="submit" class="btn btn-primary" name="AddSubject" value="Thêm">

                </form>
                <form method="post" action="admin.php">
                    <div class="form-group">
                        <span>
                            <label for="mon_hoc">Môn học:</label>
                            <select class="form-control" name="mon_hoc" id="mon_hoc">
                                <option value="All">Tất cả các môn</option>
                                <?php
                                $sql = "select MaMH, Name from mon_hoc";
                                $query = $conn->query($sql);
                                while ($row = $query->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row['MaMH'] ?>">
                                        <?php echo $row['Name'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>
                            <label for="lop">Lớp:</label>
                            <select class="form-control" name="lop" id="lop">
                                <option value="All">Tất cả các lớp</option>
                                <?php
                                $sql1 = "select ma_lop from lop";
                                $query1 = $conn->query($sql1);
                                while ($row1 = $query1->fetch_assoc()) {
                                    ?>
                                    <option value="<?php echo $row1['ma_lop'] ?>">
                                        <?php echo $row1['ma_lop'] ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </span>
                    </div>
                    <div class="form-group">
                        <span>
                            <input type="submit" class="btn btn-primary" name="filter" value="Lọc">
                        </span>
                    </div>
                </form>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Mã số sinh viên</td>
                            <td>Họ tên</td>
                            <td>Lớp</td>
                            <td>Môn học</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'select user.STUDENTID,user.NAME,user.ma_lop,mon_hoc.Name,mon_hoc.MaMH from user join table_attendance on table_attendance.STUDENTID = user.STUDENTID join mon_hoc on mon_hoc.MaMH = table_attendance.MaMH';
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['STUDENTID'] ?>
                                </td>
                                <td>
                                    <?php echo $row['NAME'] ?>
                                </td>
                                <td>
                                    <?php echo $row['ma_lop'] ?>
                                </td>
                                <td>
                                    <?php echo $row['Name'] ?>
                                </td>
                                <td>
                                    <form method="post" action="chitiet.php">
                                        <input type="hidden" name="STUDENTID" value="<?php echo $row['STUDENTID'] ?>">
                                        <input type="hidden" name="ma_lop" value="<?php echo $row['ma_lop'] ?>">
                                        <input type="hidden" name="MaMH" value="<?php echo $row['MaMH'] ?>">
                                        <!-- Button popup -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">
                                            Hiển thị chi tiết
                                        </button>
                                        <!-- Modal popup -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            
        </script>
</body>

</html>