<?php
session_start();
include_once ("config.php");

// Xử lý khi người dùng gửi yêu cầu cập nhật thông tin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $studentid = $_POST["studentid"];
    $name = $_POST["name"];
    $class = $_POST["class"];

    // Cập nhật thông tin người dùng trong cơ sở dữ liệu
    $sql = "UPDATE user SET ten = '$name', ma_lop = '$class' WHERE student_id = '$studentid'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION["success"] = "Cập nhật thông tin thành công";
    } else {
        $_SESSION["error"] = "Lỗi: " . $conn->error;
    }
    header("location: user.php");
    exit; // Kết thúc việc thực thi script sau khi chuyển hướng
}

// Lấy thông tin người dùng từ cơ sở dữ liệu để hiển thị trong form
$user = $_SESSION["loged"];
$sql = "SELECT student_id, ten, ma_lop FROM user WHERE username='$user'";
$query = $conn->query($sql);
$row = $query->fetch_assoc();
$studentid = $row["student_id"];
$name = $row["ten"];
$class = $row["ma_lop"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <?php
        include_once("header.php");
        ?>
        <h2 class="mt-5">Cập nhật thông tin người dùng</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="studentid">MSSV:</label>
                <input type="text" class="form-control" id="studentid" name="studentid"
                    value="<?php echo $studentid; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="name">Họ tên:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
            </div>
            <div class="form-group">
                <label for="class">Lớp:</label>
                <input type="text" class="form-control" id="class" name="class" value="<?php echo $class; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>

</body>

</html>