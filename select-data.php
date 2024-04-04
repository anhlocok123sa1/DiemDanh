<?php
session_start();
include_once ("config.php");
if (isset($_POST["selected"])) {
    $selected = $_POST["selected"];
    $mssv = $_POST["mssv"];
    if($selected == 'All'){
        $sql = "SELECT ID,student_id,ten,ma_lop,TIMEIN,ma_mon_hoc FROM table_attendance WHERE student_id='$mssv'";
    }else {
        $sql = "SELECT ID,student_id,ten,ma_lop,TIMEIN,ma_mon_hoc FROM table_attendance WHERE student_id='$mssv' and ma_mon_hoc='$selected'";
    }
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        ?>
        <tr>
            <td>
                <?php echo $row['ID']; ?>
            </td>
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
                <?php echo $row['TIMEIN']; ?>
            </td>
            <td>
                <?php
                $sql1 = "SELECT ten_mon_hoc FROM MON_HOC WHERE ma_mon_hoc='" . $row['ma_mon_hoc'] . "'";
                $query1 = $conn->query($sql1);
                while ($row1 = $query1->fetch_assoc()) {
                    echo $row1['ten_mon_hoc'];
                }
                ?>
            </td>
        </tr>
        <?php
    }

}
?>