<?php
session_start();
include_once ("../config.php");
if ($_SESSION["loged"] != 'admin') {
    header('location:admin/diemdanh.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['AddSubject'])) {
        $mamh = $_POST['mamh'];
        $tenmh = $_POST['tenmh'];
        if (empty($mamh)) {
            $err = 'Mã môn học is Required';
        } else if (empty($tenmh)) {
            $err = 'Tên môn học is Required';
        } else {
            $sql1 = "select * from mon_hoc where ma_mon_hoc='$mamh'";
            $rows = mysqli_query($conn, $sql1);
            $count = mysqli_num_rows($rows);
            if ($count == 0) {
                $sql = "insert into mon_hoc (`ma_mon_hoc`,`ten_mon_hoc`) values('$mamh','$tenmh')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                }
            } else {
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <script type="text/javascript" src="../js/adapter.min.js"></script>
    <script type="text/javascript" src="../js/vue.min.js"></script>
    <script type="text/javascript" src="../js/instascan.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        include_once ("../header.php");
        ?>

        <div class="row">
            <div class="card card-outline-secondary">
                <div class="card-header">
                    <h3 class="mb-0">Admin</h3>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Mã môn học</td>
                            <td>Tên Môn Học</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "select ma_mon_hoc, ten_mon_hoc from mon_hoc";
                        $query = $conn->query($sql);
                        while ($row = $query->fetch_assoc()) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ma_mon_hoc'] ?>
                                </td>
                                <td>
                                    <?php echo $row['ten_mon_hoc'] ?>
                                </td>
                                <td>
                                    <form method="post" action="delete.php">
                                        <input type="hidden" name="mamh" value="<?php echo $row['ma_mon_hoc'] ?>">
                                        <?php
                                        $sql1 = "select * from diem_danh where ma_mon_hoc ='" . $row['ma_mon_hoc'] . "'";
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
                <?php
                // Xử lý lọc dữ liệu theo môn học và lớp
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    if (isset($_POST['filter'])) {
                        $mon_hoc = $_POST['mon_hoc'];
                        $lop = $_POST['lop'];

                        if ($mon_hoc == 'All' && $lop == 'All') {
                            // Nếu chọn "Tất cả các môn" và "Tất cả các lớp", thực hiện truy vấn ban đầu
                            $sql = 'SELECT user.student_id, user.ten, user.ma_lop, mon_hoc.ten_mon_hoc AS monhoc_name 
                    FROM user 
                    JOIN diem_danh ON diem_danh.student_id = user.student_id 
                    JOIN mon_hoc ON mon_hoc.ma_mon_hoc = diem_danh.ma_mon_hoc
                    GROUP BY monhoc_name';
                        } else {
                            // Ngược lại, nếu chọn một môn học cụ thể hoặc lớp cụ thể, thêm điều kiện vào truy vấn
                            $sql = "SELECT user.student_id, user.ten, user.ma_lop, mon_hoc.ten_mon_hoc AS monhoc_name 
                    FROM user 
                    JOIN diem_danh ON diem_danh.student_id = user.student_id 
                    JOIN mon_hoc ON mon_hoc.ma_mon_hoc = diem_danh.ma_mon_hoc 
                    WHERE ";
                            $conditions = [];

                            if ($mon_hoc != 'All') {
                                $conditions[] = "mon_hoc.ma_mon_hoc = '$mon_hoc'";
                            }

                            if ($lop != 'All') {
                                $conditions[] = "user.ma_lop = '$lop'";
                            }

                            $sql .= implode(' AND ', $conditions);
                            $sql = $sql . "GROUP BY monhoc_name";
                        }

                        // Thực hiện truy vấn
                        $result_filtered = mysqli_query($conn, $sql);
                    }
                }
                ?>

                <form method="post" action="admin.php">
                    <div class="form-group">
                        <span>
                            <label for="mon_hoc">Môn học:</label>
                            <select class="form-control" name="mon_hoc" id="mon_hoc">
                                <option value="All">Tất cả các môn</option>
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
                            <td>Chi tiết</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Kiểm tra xem đã lọc theo môn học và lớp hay chưa
                        if (isset($result_filtered) && $result_filtered->num_rows > 0) {
                            while ($row = $result_filtered->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['student_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ten']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ma_lop']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['monhoc_name']; ?>
                                    </td>
                                    <td>
                                        <form action="chitiet.php" method="post">
                                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                            <?php
                                            // Truy vấn để lấy giá trị MaMH từ bảng diem_danh
                                            $sql_ma_mh = "SELECT mon_hoc.ma_mon_hoc FROM diem_danh join mon_hoc on mon_hoc.ma_mon_hoc = diem_danh.ma_mon_hoc WHERE student_id = '{$row['student_id']}' AND mon_hoc.ten_mon_hoc = '{$row['monhoc_name']}'";
                                            $result_ma_mh = $conn->query($sql_ma_mh);
                                            if ($result_ma_mh->num_rows > 0) {
                                                $row_ma_mh = $result_ma_mh->fetch_assoc();
                                                echo '<input type="hidden" name="MaMH" value="' . $row_ma_mh['ma_mon_hoc'] . '">';
                                            } else {
                                                echo '<input type="hidden" name="MaMH" value="">';
                                            }
                                            ?>
                                            <button type="submit" class="btn btn-primary">Chi tiết</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            while ($row = $query->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $row['student_id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ten']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['ma_lop']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['Name']; ?>
                                    </td>
                                    <td>
                                        <form action="admin/chitiet.php" method="post">
                                            <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                            <?php
                                            // Truy vấn để lấy giá trị MaMH từ bảng diem_danh
                                            $sql_ma_mh = "SELECT ma_mon_hoc FROM diem_danh WHERE student_id = '{$row['student_id']}'";
                                            $result_ma_mh = $conn->query($sql_ma_mh);
                                            if ($result_ma_mh->num_rows > 0) {
                                                $row_ma_mh = $result_ma_mh->fetch_assoc();
                                                echo '<input type="hidden" name="MaMH" value="' . $row_ma_mh['ma_mon_hoc'] . '">';
                                            } else {
                                                echo '<input type="hidden" name="MaMH" value="">';
                                            }
                                            ?>
                                            <button type="submit" class="btn btn-primary">Chi tiết</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>




            </div>
        </div>
        <script>
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        </script>
</body>

</html>