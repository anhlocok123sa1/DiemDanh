<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết</title>
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
            session_start();
            include_once ("config.php");
            // Kiểm tra xem đã nhận dữ liệu POST từ form hay chưa
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ form
                $studentID = $_POST["STUDENTID"];
                $maMH = $_POST["MaMH"];

                // Truy vấn để lấy thông tin chi tiết về sinh viên và môn học từ cơ sở dữ liệu
                $sql = "SELECT user.STUDENTID, user.NAME, user.ma_lop, mon_hoc.Name AS monhoc_name, table_attendance.TIMEIN
                        FROM user
                        JOIN table_attendance ON user.STUDENTID = table_attendance.STUDENTID
                        JOIN mon_hoc ON mon_hoc.MaMH = table_attendance.MaMH
                        WHERE user.STUDENTID = '$studentID' AND mon_hoc.MaMH = '$maMH'";

                // Thực thi truy vấn
                $result = $conn->query($sql);

                // Kiểm tra xem có dữ liệu trả về không
                if ($result->num_rows > 0) {
                    // Hiển thị dữ liệu
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["STUDENTID"] . "</td>";
                        echo "<td>" . $row["NAME"] . "</td>";
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