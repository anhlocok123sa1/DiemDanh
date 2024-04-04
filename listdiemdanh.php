<?php
session_start();
include_once ("config.php");

// Truy vấn để lấy danh sách các môn học
$sql = "SELECT * FROM mon_hoc";
$query = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List điểm danh</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <?php
        include_once ("header.php");
        ?>
        <h2>Danh sách điểm danh</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã môn học</th>
                    <th>Tên môn học</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $query->fetch_assoc()) { ?>
                    <tr>
                        <td>
                            <?php echo $row['MaMH']; ?>
                        </td>
                        <td>
                            <?php echo $row['Name']; ?>
                        </td>
                        <td>
                            <a href="listdiemdanh_result.php?MaMH=<?php echo $row['MaMH']; ?>"
                                class="btn btn-primary">Xem</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>