<?php
session_start();
include_once ("config.php");

$user = $_SESSION["loged"];

// Truy vấn để lấy danh sách các môn học
$sql = "
SELECT mon_hoc.ma_mon_hoc, ten_mon_hoc, user.ten, diem_danh.student_id 
FROM diem_danh join mon_hoc 
on mon_hoc.ma_mon_hoc = diem_danh.ma_mon_hoc
join user
on user.student_id = diem_danh.student_id
where username = '$user' AND diem_danh.student_id = user.student_id
GROUP BY ten_mon_hoc
";
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
                            <?php echo $row['ma_mon_hoc']; ?>
                        </td>
                        <td>
                            <?php echo $row['ten_mon_hoc']; ?>
                        </td>
                        <td>
                            <a href="listdiemdanh_result.php?MaMH=<?php echo $row['ma_mon_hoc']; ?>&tenmh=<?php echo $row['ten_mon_hoc']; ?>&mssv=<?php echo $row['student_id']; ?>"
                                class="btn btn-primary">Xem</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>