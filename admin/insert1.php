<?php
session_start();
include_once ("../config.php");

if (isset($_POST['text'])) {
    $text = $_POST['text'];
    $test = explode("-", $text);
    $mon_hoc = $_POST['mon_hoc'];
    //-----------------------------

    // Truy vấn để lấy thời gian điểm danh cuối cùng của sinh viên cho môn học đó trong ngày hiện tại
    $last_attendance_time_sql = "SELECT MAX(TIMEIN) AS last_attendance_time FROM diem_danh WHERE student_id = '$test[0]' AND ma_mon_hoc = '$mon_hoc' AND DATE(TIMEIN) = CURDATE()";
    $last_attendance_time_result = $conn->query($last_attendance_time_sql);
    if ($last_attendance_time_result && $last_attendance_time_result->num_rows > 0) {
        $last_attendance_time_row = $last_attendance_time_result->fetch_assoc();
        $last_attendance_time = strtotime($last_attendance_time_row['last_attendance_time']);
        $current_time = time();

        // Kiểm tra nếu đã qua 12 giờ kể từ lần điểm danh cuối cùng, thực hiện lệnh INSERT
        if (($current_time - $last_attendance_time) >= 12 * 3600) {
            $sql = "INSERT INTO diem_danh(student_id, ten, ma_lop, TIMEIN, ma_mon_hoc) VALUES ('$test[0]', '$test[1]', '$test[2]', NOW(), '$mon_hoc')";

            if ($conn->query($sql) === TRUE) {
                // Điểm danh thành công
            } else {
                $_SESSION['error'] = $conn->error;
            }
        } else {
            // Thời gian giữa các lần điểm danh chưa đủ 12 giờ
            $_SESSION['error'] = "Bạn chỉ được phép điểm danh môn học một lần sau mỗi 12 giờ.";
        }
    } else {
        // Không có bản ghi nào về điểm danh của sinh viên cho môn học đó trong ngày hiện tại
        $sql = "INSERT INTO diem_danh(student_id,ten,ma_lop,TIMEIN,ma_mon_hoc) VALUES('$test[0]','$test[1]','$test[2]',NOW(),'$mon_hoc')";

        if ($conn->query($sql) === TRUE) {
        } else {
            $_SESSION['error'] = $conn->error;
        }
    }
}
header("location: diemdanh.php");


$conn->close();
?>