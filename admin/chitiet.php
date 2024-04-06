<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        include_once ("../header.php");
        ?>
        <h1>Thông tin chi tiết</h1>
        <table>
            <tr>
                <th>Mã số sinh viên</th>
                <th>Họ tên</th>
                <th>Lớp</th>
                <th>Môn học</th>
                <th>Ngày quét</th>
            </tr>
            <?php
            include_once ("../config.php");
            // Kiểm tra xem đã nhận dữ liệu POST từ form hay chưa
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ form
                $studentID = $_POST["student_id"];
                $maMH = $_POST["MaMH"];

                // Truy vấn để lấy thông tin chi tiết về sinh viên và môn học từ cơ sở dữ liệu
                $sql = "SELECT user.student_id, user.ten, user.ma_lop, mon_hoc.ten_mon_hoc AS monhoc_name, diem_danh.TIMEIN
                        FROM user
                        JOIN diem_danh ON user.student_id = diem_danh.student_id
                        JOIN mon_hoc ON mon_hoc.ma_mon_hoc = diem_danh.ma_mon_hoc
                        WHERE user.student_id = '$studentID' AND mon_hoc.ma_mon_hoc = '$maMH'";

                // Thực thi truy vấn
                $result = $conn->query($sql);

                // Kiểm tra xem có dữ liệu trả về không
                if ($result->num_rows > 0) {
                    // Hiển thị dữ liệu
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["student_id"] . "</td>";
                        echo "<td>" . $row["ten"] . "</td>";
                        echo "<td>" . $row["ma_lop"] . "</td>";
                        echo "<td>" . $row["monhoc_name"] . "</td>";
                        echo "<td>" . $row["TIMEIN"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có dữ liệu để hiển thị.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Dữ liệu không hợp lệ.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>