<?php
session_start();
include_once ("config.php");
if ($_SESSION["loged"] != 'admin') {
    header('location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mamh = $_POST['mamh'];
    $tenmh = $_POST['tenmh'];
    $sql = "insert into mon_hoc (`MaMH`,`Name`) values('$mamh','$tenmh')";
    $result = mysqli_query($conn, $sql);
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

                    <button type="submit" class="btn btn-primary">
                        SignUp
                    </button>
                </form>
            </div>
        </div>
</body>

</html>