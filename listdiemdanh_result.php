<?php
session_start();
include_once("config.php");

if (isset($_GET['MaMH'])) {
    $MaMH = $_GET['MaMH'];
    
    // Truy vấn để lấy danh sách sinh viên đã điểm danh của môn học có mã là $MaMH
    $sql = "SELECT * FROM table_attendance WHERE ma_mon_hoc = '$MaMH'";
    $query = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên điểm danh</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Danh sách sinh viên điểm danh của môn học có mã <?php echo $MaMH; ?></h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>student_id</th>
                    <th>NAME</th>
                    <th>Lớp</th>
                    <th>Thời gian điểm danh</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $query->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['ten']; ?></td>
                        <td><?php echo $row['ma_lop']; ?></td>
                        <td><?php echo $row['TIMEIN']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>